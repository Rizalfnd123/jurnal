<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jam;
use App\Models\Guru;
use App\Models\Izin;
use App\Models\Absen;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tapel;
use App\Models\Jurnal;
use App\Models\Mengajar;
use App\Models\Semester;
use App\Models\Absenguru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthguruController extends Controller
{
    public function homeizin()
    {
        $guruId = Auth::user()->id;
        $guru = Guru::find($guruId);
        $today = Carbon::today();

        // Ambil hari dalam format bahasa Indonesia
        $jadtoday = Carbon::now()->locale('id')->isoFormat('dddd'); // "Senin", "Selasa", dll.

        // Ambil data jurnal dan jadwal berdasarkan hari ini
        $jurnalToday = Jurnal::whereDate('created_at', $today)
        ->whereHas('mengajar', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })
        ->get();
        $jadwalToday = Mengajar::where('hari', $jadtoday)
        ->where('guru_id', $guruId)
        ->get();
        $izinToday = Izin::whereDate('created_at', $today)
        ->whereHas('mengajar', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })
        ->get();
        $absenToday = Absenguru::whereDate('created_at', $today)
        ->where('guru_id', $guruId)
        ->get();
        $absenTodayCount = $absenToday->count();
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();
        
        $sudahAbsen = DB::table('absengurus')
            ->whereDate('created_at', now()->toDateString())
            ->where('guru_id', $guruId)
            ->exists();

        // Kirim data ke view
        return view('authguru.home-izin', compact('guru','jurnalToday','guruId','sudahAbsen',  'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount','absenToday','absenTodayCount'));
    }
    public function homejadwal()
    {
        $guruId = Auth::user()->id;
        $guru = Guru::find($guruId);
        $today = Carbon::today();

        // Ambil hari dalam format bahasa Indonesia
        $jadtoday = Carbon::now()->locale('id')->isoFormat('dddd'); // "Senin", "Selasa", dll.

        // Ambil data jurnal dan jadwal berdasarkan hari ini
        $jurnalToday = Jurnal::whereDate('created_at', $today)
        ->whereHas('mengajar', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })
        ->get();
        $jadwalToday = Mengajar::where('hari', $jadtoday)
        ->where('guru_id', $guruId)
        ->get();
        $izinToday = Izin::whereDate('created_at', $today)
        ->whereHas('mengajar', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })
        ->get();
        $absenToday = Absenguru::whereDate('created_at', $today)
        ->where('guru_id', $guruId)
        ->get();
        $absenTodayCount = $absenToday->count();
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();
        
        $sudahAbsen = DB::table('absengurus')
            ->whereDate('created_at', now()->toDateString())
            ->where('guru_id', $guruId)
            ->exists();
        // Kirim data ke view
        return view('authguru.home-jadwal', compact('guru','jurnalToday','guruId','sudahAbsen',  'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount','absenToday','absenTodayCount'));
    }
    public function jadwal(Request $request)
    {
        $search = $request->input('search');
        $hari = $request->input('hari');
        $sort_by = $request->input('sort_by', 'hari');
        $order = $request->input('order', 'asc');

        $guruId = Auth::user()->id;

        $mengajars = Mengajar::with(['jam', 'jamselesai', 'kelas', 'mapel', 'guru'])
            ->where('guru_id', $guruId) // Pastikan kolom guru_id ada di tabel mengajars
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
                return $query->where('hari', $hari);
            })
            ->orderBy(
                $sort_by == 'kelas' ? 'kelas.kelas' : ($sort_by == 'jam' ? 'jam.jam' : 'hari'),
                $order
            )
            ->select('mengajars.*')
            ->paginate(20);

        $kelas = Kelas::all();
        $jam = Jam::all();
        $mapel = Mapel::all();
        $semester = Semester::all();
        $tapel = Tapel::all();
        $guru = Guru::find($guruId);

        return view('authguru.jadwal', compact('mengajars', 'kelas', 'jam', 'mapel', 'guru', 'semester', 'tapel'));
    }

    public function jurnal()
    {
        $guruId = Auth::user()->id;

        // Mengambil data jurnal yang terkait dengan guru yang sedang login
        $jurnal = Jurnal::with(['guru', 'mapel', 'kelas'])
            ->whereHas('mengajar', function ($query) use ($guruId) {
                $query->where('guru_id', $guruId);
            })
            ->get();

        $guru = Guru::find($guruId);
        return view('authguru.jurnal', compact('jurnal', 'guru'));
    }

    public function showJadwalHariIni()
    {
        // Mendapatkan hari ini dalam format nama hari (misalnya Senin, Selasa, dll.)
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l'); // Menggunakan 'l' untuk nama hari lengkap

        // Mendapatkan jadwal berdasarkan hari ini
        $guruId = Auth::user()->id;
        $jadwalToday = Mengajar::where('hari', $hariIni)
            ->where('guru_id', $guruId)
            ->get(); // Tambahkan get() di sini untuk mengambil data dari database

        $guru = Guru::find($guruId);

        return view('authguru.jadwal-hari-ini', compact('jadwalToday', 'hariIni', 'guru'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $guruId = Auth::user()->id;
        $jurnal = Jurnal::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $jadwal = Mengajar::find($id); // Pastikan $id sesuai dengan yang diterima dari request atau route
        $absensi = Jurnal::where('mengajar_id', $jadwal->id)->first();
        $guru = Guru::find($guruId);
        return view('authguru.create-jurnal', compact('jurnal', 'kelas', 'mapel', 'guru', 'jadwal', 'absensi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('dokumentasi')) {
            $dokumentasiPath = $request->file('dokumentasi')->store('dokumentasi', 'public'); // simpan di storage/app/public/surat
            $data['dokumentasi'] = $dokumentasiPath;
        }
        Jurnal::create($data);
        $mengajar = Mengajar::find($request->mengajar_id);
        if ($mengajar) {
            $mengajar->status = 'S'; // Ubah status menjadi 'S'
            $mengajar->save();
        }

        return redirect('jurnal-guru')->with('status', 'Jurnal berhasil ditambahkan');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guruId = Auth::user()->id;
        $jurnal = jurnal::find($id);
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $guru = Guru::find($guruId);

        return view('authguru.edit-jurnal', compact('jurnal', 'kelas', 'mapel', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jurnal = Jurnal::find($id);

        // Data yang akan diperbarui
        $data = [
            'materi' => $request->materi,
        ];

        // Jika ada file dokumentasi baru yang di-upload
        if ($request->hasFile('dokumentasi')) {
            // Hapus dokumentasi lama jika ada
            if ($jurnal->dokumentasi && file_exists(storage_path('app/public/' . $jurnal->dokumentasi))) {
                unlink(storage_path('app/public/' . $jurnal->dokumentasi));
            }

            // Simpan dokumentasi baru
            $dokumentasiPath = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $data['dokumentasi'] = $dokumentasiPath;
        }

        $jurnal->update($data);

        return redirect('jurnal-guru')->with('status', 'Jurnal berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $jurnal = Jurnal::find($id);
        $jurnal->delete();
        return redirect('jurnal-guru')->with('status', 'Jurnal berhasil dihapus');
    }
    public function imagePreview($type, $id)
    {
        $item = Jurnal::findOrFail($id);

        // Menentukan gambar yang akan ditampilkan berdasarkan tipe
        if ($type == 'dokumentasi') {
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
    public function izin()
    {
        $guruId = Auth::user()->id;
        $izin = Izin::with(['guru', 'mapel', 'kelas'])
            ->whereHas('mengajar', function ($query) use ($guruId) {
                $query->where('guru_id', $guruId);
            })
            ->get();
        $guru = Guru::find($guruId);
        return view('authguru.izin', compact('izin', 'guru'));
    }
    public function createizin($id)
    {
        $guruId = Auth::user()->id;
        $izin = izin::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $guru = Guru::find($guruId);
        $jadwal = Mengajar::find($id);
        return view('authguru.create-izin', compact('izin', 'kelas', 'mapel', 'guru', 'jadwal'));
    }

    public function storeizin(Request $request)
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

        return redirect('izin-guru')->with('status', 'Izin berhasil ditambahkan');
    }

    public function editizin($id)
    {
        $guruId = Auth::user()->id;
        $izin = Izin::with('mengajar')->find($id);
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $guru = Guru::find($guruId);
        return view('authguru.edit-izin', compact('izin', 'kelas', 'mapel', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateizin(Request $request, $id)
    {
        // Ambil data request kecuali file yang di-upload
        $data = $request->except(['surat', 'lampiran']);

        // Proses upload file surat jika ada
        if ($request->hasFile('surat')) {
            $suratPath = $request->file('surat')->store('surat', 'public'); // Simpan di storage/app/public/surat
            $data['surat'] = $suratPath;
        }

        // Proses upload file lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public'); // Simpan di storage/app/public/lampiran
            $data['lampiran'] = $lampiranPath;
        }

        // Temukan record izin yang akan diupdate
        $izin = Izin::findOrFail($id);

        // Update data izin dengan data yang baru
        $izin->update($data);

        return redirect('izin-guru')->with('status', 'Izin berhasil diupdate');
    }

    public function destroyizin($id)
    {

        $izin = izin::find($id);
        $izin->delete();
        return redirect('izin-guru')->with('status', 'izin berhasil dihapus');
    }
    public function rekapjurnal()
    {
        $guruId = Auth::user()->id; // Dapatkan ID pengguna yang sedang login
        $rjurnal = Jurnal::with(['guru', 'mapel', 'kelas'])
            ->whereHas('mengajar', function ($query) use ($guruId) {
                $query->where('guru_id', $guruId);
            })
            ->get(); // Filter jurnal berdasarkan ID guru
        $kelas = Kelas::all(); // Ambil semua data kelas
        $guru = Guru::find($guruId); // Dapatkan data guru berdasarkan ID

        return view('authguru.rekap-jurnal', compact('rjurnal', 'kelas', 'guru'));
    }
    public function filterjurnal(Request $request)
    {
        $guruId = Auth::user()->id;
        $kelas = Kelas::all();

        // Ambil dan cek input bulan
        $bulanInput = $request->input('bulan');
        if ($bulanInput) {
            // Format tahun dan bulan dari input "Y-m"
            $tahun = Carbon::createFromFormat('Y-m', $bulanInput)->year;
            $bulan = Carbon::createFromFormat('Y-m', $bulanInput)->month;

            $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();
            $bulanName = Carbon::create($tahun, $bulan)->translatedFormat('F');
        } else {
            // Jika bulan kosong, gunakan bulan saat ini sebagai default
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $bulanName = Carbon::now()->translatedFormat('F');
        }

        // Ambil dan cek input kelas
        $kelasId = $request->input('kelas');
        $selectedKelas = Kelas::find($kelasId)->kelas ?? '';

        // Mengambil data jurnal terkait berdasarkan bulan dan kelas (dan hanya milik guru yang login)
        $rjurnal = Jurnal::with('mengajar')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->whereHas('mengajar', function ($query) use ($kelasId, $guruId) {
                $query->where('guru_id', $guruId);
                if ($kelasId) {
                    $query->where('kelas_id', $kelasId);
                }
            })
            ->get();

        $guru = Guru::find($guruId);
        return view('authguru.filter-jurnal', compact('rjurnal', 'kelas', 'bulanName', 'selectedKelas','guru'));
    }
    public function rekapizin()
    {
        $guruId = Auth::user()->id;
        $rizin = Izin::with(['guru', 'mapel', 'kelas'])
        ->whereHas('mengajar', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })
        ->get();
        $kelas = Kelas::all(); // Menggunakan nama variabel yang konsisten
        $guru = Guru::find($guruId);
        return view('authguru.rekap-izin', compact('rizin', 'kelas','guru'));
    }

    public function filterizin(Request $request)
    {
        $guruId = Auth::user()->id;
        $kelas = Kelas::all();

        // Ambil dan cek input bulan
        $bulanInput = $request->input('bulan');
        if ($bulanInput) {
            // Format tahun dan bulan dari input "Y-m"
            $tahun = Carbon::createFromFormat('Y-m', $bulanInput)->year;
            $bulan = Carbon::createFromFormat('Y-m', $bulanInput)->month;

            $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();
            $bulanName = Carbon::create($tahun, $bulan)->translatedFormat('F');
        } else {
            // Jika bulan kosong, gunakan bulan saat ini sebagai default
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $bulanName = Carbon::now()->translatedFormat('F');
        }

        // Ambil dan cek input kelas
        $kelasId = $request->input('kelas');
        $selectedKelas = Kelas::find($kelasId)->kelas ?? '';

        // Mengambil data izin terkait
        $rizin = Izin::with('mengajar')
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->whereHas('mengajar', function ($query) use ($kelasId, $guruId) {
            $query->where('guru_id', $guruId);
            if ($kelasId) {
                $query->where('kelas_id', $kelasId);
            }
        })
        ->get();

            $guru = Guru::find($guruId);
        return view('authguru.filter-izin', compact('rizin', 'kelas', 'bulanName', 'selectedKelas','guru'));
    }
    public function rekapkbm()
    {
        $guruId = Auth::user()->id;
        $rkbm = Mengajar::where('guru_id', $guruId)
        ->get();
        $kelas = Kelas::all(); // Menggunakan nama variabel yang konsisten
        $guru = Guru::find($guruId);
        return view('authguru.rekap-kbm', compact('rkbm', 'kelas','guru','guru'));
    }

    public function filterkbm(Request $request)
    {
        $guruId = Auth::user()->id;
        $kelas = Kelas::all(); // Menggunakan nama variabel yang konsisten
        // Ambil input dari request
        $bulanInput = $request->input('bulan');
        $kelasId = $request->input('kelas');

        // Pastikan input bulan dalam format "Y-m" (misalnya "2024-09" untuk September)
        $tahun = Carbon::createFromFormat('Y-m', $bulanInput)->year;
        $bulan = Carbon::createFromFormat('Y-m', $bulanInput)->month;

        // Mengambil awal dan akhir bulan berdasarkan input
        $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
        $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();

        // Mengambil nama bulan dengan format yang tepat
        $bulanName = Carbon::createFromFormat('Y-m', $bulanInput)->translatedFormat('F');

        // Mendapatkan nama kelas dari ID yang dipilih
        $selectedKelas = Kelas::find($kelasId)->kelas ?? '';

        // Ambil data Mengajar berdasarkan bulan dan kelas
        $mengajars = Mengajar::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('kelas_id', $kelasId)
            ->where('guru_id', $guruId)
            ->get();

        // Hitung jumlah jurnal dan izin untuk masing-masing data Mengajar
        $rkbm = $mengajars->map(function ($mengajar) {
            return (object) [
                'mapel' => $mengajar->mapel,
                'guru' => $mengajar->guru,
                'hadir_count' => $mengajar->jurnal->count(),
                'izin_count' => $mengajar->izin->count(),
                'total' => 2 // Asumsi jumlah wajib hadir adalah 2
            ];
        });

        $pesan = "Berikut ini data dengan bulan $bulanName dan kelas $selectedKelas";

        $guru = Guru::find($guruId);
        // Return view dengan data yang diolah
        return view('authguru.filter-kbm', compact('rkbm', 'kelas', 'pesan', 'bulanName', 'selectedKelas','guru'));
    }
    public function rekapabsensi()
    {
        $guruId = Auth::user()->id;
        $rabsen = Absen::all();
        $kelas = Kelas::all(); // Menggunakan nama variabel yang konsisten
        $guru = Guru::find($guruId);
        return view('authguru.rekap-absensi', compact('rabsen', 'kelas','guru'));
    }

    public function filterabsensi(Request $request)
    {
        $guruId = Auth::user()->id;
        $kelas = Kelas::all();
        $bulanInput = $request->input('bulan');

        // Pastikan input bulan dalam format "Y-m"
        $tahun = Carbon::createFromFormat('Y-m', $bulanInput)->year;
        $bulan = Carbon::createFromFormat('Y-m', $bulanInput)->month;

        $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
        $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();

        $bulanName = Carbon::create($tahun, $bulan)->translatedFormat('F');

        $kelasId = $request->input('kelas');
        $selectedKelas = Kelas::find($kelasId)->kelas ?? '';

        // Mengambil data Absens terkait dengan join ke mengajars untuk mendapatkan kelas_id
        $rabsen = Absen::with('siswa', 'jurnal')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->whereHas('jurnal', function ($query) use ($kelasId) {
                $query->whereHas('mengajar', function ($q) use ($kelasId) {
                    $q->where('kelas_id', $kelasId);
                });
            })
            ->get()
            ->groupBy('siswas_id');

            $guru = Guru::find($guruId);
        return view('authguru.filter-absensi', compact('rabsen', 'kelas', 'bulanName', 'selectedKelas','guru'));
    }
}
