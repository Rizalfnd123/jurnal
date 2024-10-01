<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurnal; // Pastikan model Jurnal sudah ada
use App\Models\Mengajar; 
use App\Models\Izin; 
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function login(){
        return view('login');
    }
    public function index()
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
        return view('home', compact('jurnalToday', 'jurnalTodayCount','jadwalToday', 'jadwalTodayCount','izinToday','izinTodayCount'));
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
        return view('homeguru', compact('jurnalToday', 'jurnalTodayCount','jadwalToday', 'jadwalTodayCount','izinToday','izinTodayCount'));
    }
    public function jadwal()
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
        return view('homejad', compact('jurnalToday', 'jurnalTodayCount','jadwalToday', 'jadwalTodayCount','izinToday','izinTodayCount'));
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
        return view('homeizin', compact('jurnalToday', 'jurnalTodayCount','jadwalToday', 'jadwalTodayCount','izinToday','izinTodayCount'));
    }
}
