<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jam;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tapel;
use App\Models\Siswas;
use App\Models\Mengajar;
use App\Models\Semester;
use App\Models\Absenguru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PimpinanController extends Controller
{
    public function home()
    {
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');
        $today = Carbon::today();
        $guru = Guru::all();
        $siswa = Siswas::all();
        $absenguru = Absenguru::whereDate('created_at', $today)->get();
        $jadwal = Mengajar::where('hari', $hariIni)->get();
        $gurutotal = $guru->count();
        $siswatotal = $siswa->count();
        $absenToday = $absenguru->count();
        $jadwalToday = $jadwal->count();
        return view('pimpinan.homepimpinan', compact('gurutotal','siswatotal','absenToday','jadwalToday','absenguru'));
    }
    public function guru(Request $request)
    {
        $perPage = $request->get('perPage', 20);
        $guru = DB::table('guru')->paginate($perPage);
        return view('pimpinan.guru', ['guru' => $guru]);
    }
    public function siswa()
    {
        $siswas = Siswas::paginate(20);
        // return $siswas;
        return view('pimpinan.siswa', ['siswas' => $siswas]);
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
        return view('pimpinan.jadwal', compact('mengajars', 'kelas', 'jam', 'mapel', 'guru', 'semester', 'tapel'));
    }
    public function rekap()
    {
        $rabsenguru = Absenguru::all();
        $guru = Guru::all(); // Menggunakan nama variabel yang konsisten
        return view('pimpinan.rekap', compact('rabsenguru', 'guru'));
    }
    public function filter(Request $request)
    {
        $query = DB::table('absengurus')
            ->join('guru', 'absengurus.guru_id', '=', 'guru.id')
            ->select('absengurus.*', 'guru.nama as guru_nama');

        $guru = Guru::all();
        $inputguru = $request->input('guru');
        $selectedGuru = Guru::find($inputguru)->nama ?? '';
        $selectedBulan = $request->input('bulan');

        $daysWithData = [];
        $bulanName = '';

        if ($selectedBulan) {
            $tahun = Carbon::createFromFormat('Y-m', $selectedBulan)->year;
            $bulan = Carbon::createFromFormat('Y-m', $selectedBulan)->month;

            $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();

            $bulanName = Carbon::create($tahun, $bulan)->translatedFormat('F');
            $query->whereBetween('absengurus.created_at', [$startOfMonth, $endOfMonth]);

            // Mengelompokkan data hadir berdasarkan tanggal
            $absenData = $query->get();
            foreach ($absenData as $data) {
                $day = Carbon::parse($data->created_at)->day;
                $time = Carbon::parse($data->created_at)->format('H:i');
                $daysWithData[$day] = $time;  // Simpan waktu (jam:menit) untuk tanggal tersebut
            }
        }

        if (!empty($inputguru)) {
            $query->where('absengurus.guru_id', $inputguru);
        }

        $filteredData = $query->get();

        return view('pimpinan.filter', compact('filteredData', 'selectedGuru', 'bulanName', 'guru', 'daysWithData', 'selectedBulan'));
    }
}
