<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurnal; // Pastikan model Jurnal sudah ada
use App\Models\Mengajar;
use App\Models\Izin;
use Carbon\Carbon;

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

    // Hitung jumlah jurnal, jadwal, dan izin hari ini
    $jurnalTodayCount = $jurnalToday->count();
    $jadwalTodayCount = $jadwalToday->count();
    $izinTodayCount = $izinToday->count();

    // Kirim data ke view
    return view('home', compact('jurnalToday', 'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount'));
}
    public function indexguru()
    {
        // Ambil data jurnal hari ini
        $today = Carbon::today();
        $jurnalToday = Jurnal::whereDate('created_at', $today)->get();
        $jadwalToday = Mengajar::whereDate('created_at', $today)->get();
        $izinToday = Izin::whereDate('created_at', $today)->get();

        // Hitung jumlah jurnal hari ini
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();

        // Kirim data ke view
        return view('homeguru', compact('jurnalToday', 'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount'));
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
    
        // Hitung jumlah jurnal, jadwal, dan izin hari ini
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();
    
        // Kirim data ke view
        return view('homejad', compact('jurnalToday', 'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount'));
    }
    public function izin()
    {
        // Ambil data jurnal hari ini
        $today = Carbon::today();
        $jurnalToday = Jurnal::whereDate('created_at', $today)->get();
        $jadwalToday = Mengajar::whereDate('created_at', $today)->get();
        $izinToday = Izin::whereDate('created_at', $today)->get();

        // Hitung jumlah jurnal hari ini
        $jurnalTodayCount = $jurnalToday->count();
        $jadwalTodayCount = $jadwalToday->count();
        $izinTodayCount = $izinToday->count();

        // Kirim data ke view
        return view('homeizin', compact('jurnalToday', 'jurnalTodayCount', 'jadwalToday', 'jadwalTodayCount', 'izinToday', 'izinTodayCount'));
    }
}
