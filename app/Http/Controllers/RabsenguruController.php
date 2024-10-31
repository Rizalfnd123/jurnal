<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guru;
use App\Models\Absenguru;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class RabsenguruController extends Controller
{
    public function data()
    {
        $rabsenguru = Absenguru::all();
        $guru = Guru::all(); // Menggunakan nama variabel yang konsisten
        return view('rabsenguru.data', compact('rabsenguru', 'guru'));
    }

    public function filter(Request $request)
    {
        $query = DB::table('absengurus')
            ->join('guru', 'absengurus.guru_id', '=', 'guru.id')
            ->select('absengurus.*', 'guru.nama as guru_nama');

        $guru = Guru::all();

        // Ambil input guru dan bulan
        $inputguru = $request->input('guru');
        $selectedGuru = Guru::find($inputguru)->nama ?? '';
        $selectedBulan = $request->input('bulan');

        if ($selectedBulan) {
            $tahun = Carbon::createFromFormat('Y-m', $selectedBulan)->year;
            $bulan = Carbon::createFromFormat('Y-m', $selectedBulan)->month;

            $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();

            $bulanName = Carbon::create($tahun, $bulan)->translatedFormat('F');

            // Filter berdasarkan absengurus.created_at di bulan tersebut
            $query->whereBetween('absengurus.created_at', [$startOfMonth, $endOfMonth]);
        } else {
            $bulanName = '';
        }

        if (!empty($inputguru)) {
            $query->where('absengurus.guru_id', $inputguru);
        }

        $filteredData = $query->get();

        return view('rabsenguru.filter', compact('filteredData', 'selectedGuru', 'bulanName', 'guru'));
    }
}
