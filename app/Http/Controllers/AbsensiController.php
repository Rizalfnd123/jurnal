<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Mengajar;
use App\Models\Siswas;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function create(Request $request)
{
    $jurnalId = $request->query('jurnal_id');

    // Cari data jurnal berdasarkan ID
    $jurnal = Jurnal::with(['guru', 'mapel', 'kelas','jam'])->findOrFail($jurnalId);

    // Cari daftar siswa yang sesuai dengan kelas di jurnal
    $siswaList = Siswas::where('kelas_id', $jurnal->mengajar->kelas_id)->get();

    // Kirim data ke view
    return view('absensi.create', compact('jurnal', 'siswaList','jurnalId'));
}

public function store(Request $request)
{
    $hadirList = $request->input('hadir', []);
    $izinList = $request->input('izin', []);
    $sakitList = $request->input('sakit', []);
    $alpaList = $request->input('alpa', []);

    $totalHadir = count($hadirList);
    $totalTidakHadir = count($izinList) + count($sakitList) + count($alpaList);

    $siswaIds = $request->input('siswa_id', []);
    $jurnalsId = $request->input('jurnals_id' ); // Pastikan ini tidak null
    // $jurnalsId = $request->input('jurnal_id' ); 

    if (is_array($siswaIds) && count($siswaIds) > 0) {
        foreach ($siswaIds as $siswaId) {
            $ket = null;

            if (isset($hadirList[$siswaId])) {
                $ket = 'H'; // Hadir
            } elseif (isset($izinList[$siswaId])) {
                $ket = 'I'; // Izin
            } elseif (isset($sakitList[$siswaId])) {
                $ket = 'S'; // Sakit
            } elseif (isset($alpaList[$siswaId])) {
                $ket = 'A'; // Alpa
            }

            if ($ket) {
                Absen::create([
                    'jurnals_id' => $jurnalsId, // Pastikan ini diisi dengan benar
                    'siswas_id' => $siswaId,
                    'ket' => $ket,
                ]);
            }
        }

        $jurnal = Jurnal::find($jurnalsId);
        if ($jurnal) {
            $jurnal->hadir = $totalHadir;
            $jurnal->tidak_hadir = $totalTidakHadir;
            $jurnal->save();
        }

        return redirect()->route('jurnal.index')->with('success', 'Data absensi berhasil disimpan dan jurnal diperbarui.');
    }
}




}
