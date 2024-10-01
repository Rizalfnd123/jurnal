<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Mengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JadwalhariController extends Controller
{

    public function showJadwalHariIni()
    {
        // Mendapatkan hari ini dalam format nama hari (misalnya Senin, Selasa, dll.)
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l'); // Menggunakan 'l' untuk nama hari lengkap
    
        // Mendapatkan jadwal berdasarkan hari ini
        $jadwalToday = Mengajar::where('hari', $hariIni)->get();
    
        return view('jadwal-hari-ini', compact('jadwalToday', 'hariIni'));
    }
}
