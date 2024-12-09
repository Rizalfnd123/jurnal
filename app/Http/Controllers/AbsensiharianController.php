<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Siswas;
use App\Models\Absensiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiharianController extends Controller
{
    public function home()
    {
        $today = Carbon::today();
        $kelas = Kelas::all();
        $siswa = Siswas::all();
        $rekapAbsensi = DB::table('absensiswas')
            ->join('siswas', 'absensiswas.siswas_id', '=', 'siswas.id')
            ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->select('absensiswas.hari', DB::raw('DATE(absensiswas.created_at) as tanggal'), 'kelas.kelas')
            ->distinct()
            ->get();
        $absensi = Absensiswa::whereDate('created_at', $today)->get();
        $jumlahsiswa = $siswa->count();
        $jumlahkelas = $kelas->count();
        $jumlahrekap = $rekapAbsensi->count();
        $absensitoday = $absensi->count();
        return view('absensiharian.homebk', compact('siswa', 'jumlahsiswa','jumlahkelas','jumlahrekap','absensitoday'));
    }
    public function siswa()
    {
        $siswas = Siswas::paginate(15);
        // return $siswas;
        return view('absensiharian.siswa', ['siswas' => $siswas]);
    }
    public function absen(Request $request)
    {
        // Mengambil hari ini dan tanggal sekarang
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');
        $tanggalSekarang = Carbon::now()->format('d F Y');

        // Mengambil semua data kelas
        $kelasList = Kelas::all();

        // Mengambil kelas yang dipilih (jika ada)
        $kelasId = $request->input('kelas_id');
        $siswaList = [];

        if ($kelasId) {
            // Ambil siswa yang berelasi dengan kelas yang dipilih
            $siswaList = Siswas::where('kelas_id', $kelasId)->get();
        }

        return view('absensiharian.index', compact('hariIni', 'tanggalSekarang', 'kelasList', 'siswaList', 'kelasId'));
    }
    public function store(Request $request)
    {
        $absensiData = $request->input('absensi');
        $hari = Carbon::now()->locale('id')->translatedFormat('l');

        foreach ($absensiData as $siswaId => $data) {
            Absensiswa::create([
                'hari' => $hari,
                'siswas_id' => $siswaId,
                'ket' => $data['ket'],
            ]);
        }

        return redirect()->route('absensiharian.index')->with('success', 'Absensi berhasil disimpan.');
    } // AbsensiharianController.php

    public function rekap()
    {
        $rekapAbsensi = DB::table('absensiswas')
            ->join('siswas', 'absensiswas.siswas_id', '=', 'siswas.id')
            ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->select('absensiswas.hari', DB::raw('DATE(absensiswas.created_at) as tanggal'), 'kelas.kelas')
            ->distinct()
            ->get();


        return view('absensiharian.rekap', compact('rekapAbsensi'));
    }

    public function detailRekap($hari, $tanggal, $kelas)
    {
        // Mengambil data absensi berdasarkan hari, tanggal, dan kelas yang diberikan
        $absensi = DB::table('absensiswas')
            ->join('siswas', 'absensiswas.siswas_id', '=', 'siswas.id')
            ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id') // Asumsi siswas memiliki kelas_id
            ->where('absensiswas.hari', $hari)
            ->whereDate('absensiswas.created_at', $tanggal)
            ->where('kelas.kelas', $kelas)
            ->select('absensiswas.hari', 'absensiswas.created_at', 'kelas.kelas')
            ->first();

        // Periksa apakah data absensi ditemukan
        if (!$absensi) {
            return redirect()->route('absensiharian.rekap')->with('error', 'Data absensi tidak ditemukan');
        }

        // Mengambil data siswa yang terkait dengan absensi berdasarkan hari, tanggal, dan kelas
        $siswaList = DB::table('absensiswas')
            ->join('siswas', 'absensiswas.siswas_id', '=', 'siswas.id')
            ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->where('absensiswas.hari', $hari)
            ->whereDate('absensiswas.created_at', $tanggal)
            ->where('kelas.kelas', $kelas)
            ->select('siswas.nama', 'siswas.nis', 'absensiswas.ket', )
            ->get();

        return view('absensiharian.detailrekap', compact('absensi', 'siswaList'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'ket' => 'required|in:H,S,I,A',
        ]);

        DB::table('absensiswas')
            ->where('id', $id)
            ->update(['ket' => $request->ket]);

        return redirect()->back()->with('success', 'Status kehadiran berhasil diperbarui.');
    }
}
