<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Izin;
use Barryvdh\DomPDF\Facade\Pdf;

class RizinController extends Controller
{
    public function data()
    {
        $rizin = Izin::all();
        $kelas = Kelas::all(); // Menggunakan nama variabel yang konsisten
        return view('rizin.data', compact('rizin', 'kelas'));
    }

    public function filter(Request $request)
    {
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

        // Mengambil data izin terkait
        $rizin = Izin::with('mengajar')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->whereHas('mengajar', function ($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            })
            ->get();

        return view('rizin.filter', compact('rizin', 'kelas', 'bulanName', 'selectedKelas'));
    }

    public function exportPdf(Request $request)
    {
        $filterData = $request->only('awal', 'akhir', 'kelas');

        $rizin = izin::when(isset($filterData['awal']), function ($query) use ($filterData) {
            $query->whereDate('created_at', '>=', $filterData['awal']);
        })->when(isset($filterData['akhir']), function ($query) use ($filterData) {
            $query->whereDate('created_at', '<=', $filterData['akhir']);
        })->when(isset($filterData['kelas']), function ($query) use ($filterData) {
            $query->where('kelas_id', $filterData['kelas']);
        })->get();

        $pdf = Pdf::loadView('pdf.rizin', compact('rizin'));
        return $pdf->download('data_rizin.pdf');
    }
}
