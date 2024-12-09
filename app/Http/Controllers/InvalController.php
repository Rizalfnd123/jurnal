<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jam;
use App\Models\Guru;
use App\Models\Izin;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tapel;
use App\Models\Mengajar;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvalController extends Controller
{
    public function home()
    {
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');
        $today = Carbon::today();
        $guru = Guru::all();
        $izin = Izin::whereDate('created_at', $today)->get();
        $tizin = Izin::all();
        $jadwal = Mengajar::where('hari', $hariIni)->get();
        $jumlahguru = $guru->count();
        $izintoday = $izin->count();
        $izintotal = $tizin->count();
        $jadwalToday = $jadwal->count();
        return view('inval.homeinval', compact('jumlahguru','izintoday','izintotal','jadwalToday'));
    }
    public function jadwal(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian
        $hari = $request->input('hari'); // Ambil input filter hari
        $sort_by = $request->input('sort_by', 'hari'); // Default sorting by 'hari'
        $order = $request->input('order', 'asc'); // Default order is ascending

        $mengajars = Mengajar::with(['jam', 'jamselesai', 'kelas', 'mapel', 'guru'])
            ->leftJoin('kelas', 'mengajars.kelas_id', '=', 'kelas.id') // Join tabel kelas
            ->leftJoin('jam', 'mengajars.jam_id', '=', 'jam.id') // Join tabel jam
            ->when($search, function ($query, $search) {
                return $query->where('hari', 'like', "%{$search}%")
                    ->orWhereHas('mapel', function ($query) use ($search) {
                        $query->where('mapel', 'like', "%{$search}%");
                    })
                    ->orWhereHas('guru', function ($query) use ($search) {
                        $query->where('nama', 'like', "%{$search}%");
                    });
            })
            ->when($hari, function ($query, $hari) {
                return $query->where('hari', $hari); // Filter hari lebih awal
            })
            ->orderBy(
                $sort_by == 'kelas' ? 'kelas.kelas' : ($sort_by == 'jam' ? 'jam.jam' : 'hari'),
                $order
            )
            ->select('mengajars.*') // Select data utama dari tabel mengajars
            ->paginate(20);

        // Ambil data tambahan
        $kelas = Kelas::all();
        $jam = Jam::all();
        $mapel = Mapel::all();
        $semester = Semester::all();
        $guru = Guru::all();
        $tapel = Tapel::all();

        // Kirim data ke view
        return view('inval.jadwal', compact('mengajars', 'kelas', 'jam', 'mapel', 'guru', 'semester', 'tapel'));
    }
    public function izin()
    {
        $izin = Izin::with(['guru', 'mapel', 'kelas'])->get();
        return view('inval.izin', compact('izin'));
    }
    public function showJadwalHariIni()
    {
        // Mendapatkan hari ini dalam format nama hari (misalnya Senin, Selasa, dll.)
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l'); // Menggunakan 'l' untuk nama hari lengkap

        // Mendapatkan jadwal berdasarkan hari ini
        $jadwalToday = Mengajar::where('hari', $hariIni)->get();

        return view('inval.jadwalhariini', compact('jadwalToday', 'hariIni'));
    }
    public function create($id)
    {
        $izin = izin::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $guru = Guru::all();
        $jadwal = Mengajar::find($id);
        return view('inval.create', compact('izin', 'kelas', 'mapel', 'guru', 'jadwal'));
    }

    public function store(Request $request)
    {
        // Validasi data termasuk file
        $request->validate([
            'surat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // sesuaikan aturan validasi jika perlu
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // tambahkan aturan validasi lain sesuai kebutuhan
        ]);

        $data = $request->all();

        // Proses upload file surat jika ada
        if ($request->hasFile('surat')) {
            $suratPath = $request->file('surat')->store('surat', 'public'); // simpan di storage/app/public/surat
            $data['surat'] = $suratPath;
        }

        // Proses upload file lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public'); // simpan di storage/app/public/lampiran
            $data['lampiran'] = $lampiranPath;
        }

        // Simpan data ke database
        $izin = Izin::create($data);

        // Update status mengajar jika ditemukan
        $mengajar = Mengajar::find($request->mengajar_id);
        if ($mengajar) {
            $mengajar->status = 'I';
            $mengajar->save();
        }

        return redirect('invalizin')->with('status', 'Izin berhasil ditambahkan');
    }

    public function edit($id)
    {

        $izin = Izin::with('mengajar')->find($id);
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $guru = Guru::all();
        return view('inval.edit', compact('izin', 'kelas', 'mapel', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $izin = izin::find($id);
        izin::where('id', $izin->id)
            ->update([
                'tanggal' => $request->tanggal,
                'kelas_id' => $request->kelas_id,
                'mapel_id' => $request->mapel_id,
                'guru_id' => $request->guru_id,
                'ket' => $request->ket,
                'surat' => $request->surat,
                'kegiatan' => $request->kegiatan,
                'lampiran' => $request->lampiran,
            ]);
        return redirect('invalizin')->with('status', 'Jadwal berhasil diupdate');
    }
    public function destroy($id)
    {

        $izin = izin::find($id);
        $izin->delete();
        return redirect('invalizin')->with('status', 'izin berhasil dihapus');
    }
    public function imagePreview($type, $id)
    {
        $item = Izin::findOrFail($id);

        // Menentukan gambar yang akan ditampilkan berdasarkan tipe
        if ($type == 'surat') {
            $imagePath = storage_path('app/public/' . $item->surat);
        } elseif ($type == 'lampiran') {
            $imagePath = storage_path('app/public/' . $item->lampiran);
        } elseif ($type == 'dokumentasi') {
            $imagePath = storage_path('app/public/' . $item->dokumentasi);
        } else {
            abort(404);
        }

        // Pastikan file gambar ada
        if (!file_exists($imagePath)) {
            abort(404);
        }

        // Menampilkan gambar
        return response()->file($imagePath);
    }
    public function rekap()
    {
        $rizin = Izin::all();
        $mapel = Mapel::all();
        $guru = Guru::all(); // Menggunakan nama variabel yang konsisten
        return view('inval.rizin', compact('rizin', 'mapel', 'guru'));
    }
    public function filter(Request $request)
    {
        $mapel = Mapel::all();
        $guru = Guru::all();
        $mapel_id = $request->input('mapel');
        $guru_id = $request->input('guru');

        // Filter data berdasarkan mapel dan guru
        $results = Izin::whereHas('mengajar', function ($query) use ($mapel_id, $guru_id) {
            $query->where('mapel_id', $mapel_id)
                ->where('guru_id', $guru_id);
        })->get();

        $selectedmapel = Mapel::find($mapel_id);  // Ambil nama mapel berdasarkan mapel_id
        $selectedguru = Guru::find($guru_id);

        return view('inval.filter', compact('results', 'mapel_id', 'guru_id', 'mapel', 'guru', 'selectedmapel', 'selectedguru'));
    }
}
