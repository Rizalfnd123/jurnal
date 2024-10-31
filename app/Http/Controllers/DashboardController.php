<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guru;
use App\Models\Izin;
use App\Models\Mengajar;
use App\Models\Absenguru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Jurnal; // Pastikan model Jurnal sudah ada

class DashboardController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function index()
    {
        // Ambil hari ini dengan Carbon dalam format lokal
        $today = Carbon::today();

        // Ambil hari dalam format bahasa Indonesia
        $jadtoday = Carbon::now()->locale('id')->isoFormat('dddd'); // "Senin", "Selasa", dll.

        // Ambil data jurnal dan jadwal berdasarkan hari ini
        $jurnalToday = Jurnal::whereDate('created_at', $today)->get();
        $jadwalToday = Mengajar::where('hari', $jadtoday)->get();
        $izinToday = Izin::whereDate('created_at', $today)->get();
        $absenToday = Absenguru::whereDate('created_at', $today)->get();
        $absenTodayCount = $absenToday->count();

        // Hitung jumlah jurnal, jadwal, dan izin hari ini
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();

        // Kirim data ke view
        return view('home', compact('jurnalToday', 'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount','absenToday','absenTodayCount'));
    }
    public function indexguru()
    {
        $today = Carbon::today();

        // Ambil hari dalam format bahasa Indonesia
        $jadtoday = Carbon::now()->locale('id')->isoFormat('dddd'); // "Senin", "Selasa", dll.

        // Ambil data jurnal dan jadwal berdasarkan hari ini
        $jurnalToday = Jurnal::whereDate('created_at', $today)->get();
        $jadwalToday = Mengajar::where('hari', $jadtoday)->get();
        $izinToday = Izin::whereDate('created_at', $today)->get();
        $absenToday = Absenguru::whereDate('created_at', $today)->get();
        $absenTodayCount = $absenToday->count();

        // Hitung jumlah jurnal, jadwal, dan izin hari ini
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();
        
        $guruId = Auth::user()->id;
        $guru = Guru::find($guruId);
        $sudahAbsen = DB::table('absengurus')
            ->whereDate('created_at', now()->toDateString())
            ->where('guru_id', $guruId)
            ->exists();
        // Kirim data ke view
        return view('homeguru', compact('guru','jurnalToday','guruId','sudahAbsen',  'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount','absenToday','absenTodayCount'));
    }
    public function jadwal()
    {
        // Ambil hari ini dengan Carbon dalam format lokal
        $today = Carbon::today();

        // Ambil hari dalam format bahasa Indonesia
        $jadtoday = Carbon::now()->locale('id')->isoFormat('dddd'); // "Senin", "Selasa", dll.

        // Ambil data jurnal dan jadwal berdasarkan hari ini
        $jurnalToday = Jurnal::whereDate('created_at', $today)->get();
        $jadwalToday = Mengajar::where('hari', $jadtoday)->get();
        $izinToday = Izin::whereDate('created_at', $today)->get();
        $absenToday = Absenguru::whereDate('created_at', $today)->get();
        $absenTodayCount = $absenToday->count();

        // Hitung jumlah jurnal, jadwal, dan izin hari ini
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();

        // Kirim data ke view
        return view('homejad', compact('jurnalToday', 'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount','absenToday','absenTodayCount'));
    }
    public function izin()
    {
        // Ambil data jurnal hari ini
        $today = Carbon::today();
        $jurnalToday = Jurnal::whereDate('created_at', $today)->get();
        $jadwalToday = Mengajar::whereDate('created_at', $today)->get();
        $izinToday = Izin::whereDate('created_at', $today)->get();
        $absenToday = Absenguru::whereDate('created_at', $today)->get();
        $absenTodayCount = $absenToday->count();

        // Hitung jumlah jurnal hari ini
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();

        // Kirim data ke view
        return view('homeizin', compact('jurnalToday', 'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount','absenToday','absenTodayCount'));
    }
    public function absen()
    {
        // Ambil hari ini dengan Carbon dalam format lokal
        $today = Carbon::today();

        // Ambil hari dalam format bahasa Indonesia
        $jadtoday = Carbon::now()->locale('id')->isoFormat('dddd'); // "Senin", "Selasa", dll.

        // Ambil data jurnal dan jadwal berdasarkan hari ini
        $jurnalToday = Jurnal::whereDate('created_at', $today)->get();
        $jadwalToday = Mengajar::where('hari', $jadtoday)->get();
        $izinToday = Izin::whereDate('created_at', $today)->get();
        $absenToday = Absenguru::whereDate('created_at', $today)->get();
        $absenTodayCount = $absenToday->count();
        // Hitung jumlah jurnal, jadwal, dan izin hari ini
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();

        // Kirim data ke view
        return view('homeabsen', compact('jurnalToday', 'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount','absenToday','absenTodayCount'));
    }
}
