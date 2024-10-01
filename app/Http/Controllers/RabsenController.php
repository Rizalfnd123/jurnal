<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Absen;
use Barryvdh\DomPDF\Facade\Pdf;

class RabsenController extends Controller
{
    public function data()
    {
        $rabsen = absen::all();
        $kelas = Kelas::all(); // Menggunakan nama variabel yang konsisten
        return view('rabsen.data', compact('rabsen', 'kelas'));
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

    return view('rabsen.filter', compact('rabsen', 'kelas', 'bulanName', 'selectedKelas'));
}





    public function exportPdf(Request $request)
    {
        $filterData = $request->only('awal', 'akhir', 'kelas');
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');
        $kelas_id = $request->input('kelas');

        $rabsen = absen::when(isset($filterData['awal']), function ($query) use ($filterData) {
            $query->whereDate('created_at', '>=', $filterData['awal']);
        })->when(isset($filterData['akhir']), function ($query) use ($filterData) {
            $query->whereDate('created_at', '<=', $filterData['akhir']);
        })->when(isset($filterData['kelas']), function ($query) use ($filterData) {
            $query->where('kelas_id', $filterData['kelas']);
        })->get();

        $pdf = Pdf::loadView('pdf.rabsen', compact('rabsen', 'awal', 'akhir'));
        return $pdf->download('data_rabsen.pdf');
    }
}
