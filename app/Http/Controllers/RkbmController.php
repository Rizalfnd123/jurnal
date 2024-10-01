<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mengajar;
use Barryvdh\DomPDF\Facade\Pdf;

class RkbmController extends Controller
{
    public function data()
    {
        $rkbm = Mengajar::all();
        $kelas = Kelas::all(); // Menggunakan nama variabel yang konsisten
        return view('rkbm.data', compact('rkbm', 'kelas'));
    }

    public function filter(Request $request)
    {
        $kelas = Kelas::all(); // Menggunakan nama variabel yang konsisten
        // Ambil input dari request
        $bulanInput = $request->input('bulan');
        $kelasId = $request->input('kelas');

        // Pastikan input bulan dalam format "Y-m" (misalnya "2024-09" untuk September)
        $tahun = Carbon::createFromFormat('Y-m', $bulanInput)->year;
        $bulan = Carbon::createFromFormat('Y-m', $bulanInput)->month;

        // Mengambil awal dan akhir bulan berdasarkan input
        $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
        $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();

        // Mengambil nama bulan dengan format yang tepat
        $bulanName = Carbon::createFromFormat('Y-m', $bulanInput)->translatedFormat('F');

        // Mendapatkan nama kelas dari ID yang dipilih
        $selectedKelas = Kelas::find($kelasId)->kelas ?? '';

        // Ambil data Mengajar berdasarkan bulan dan kelas
        $mengajars = Mengajar::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('kelas_id', $kelasId)
            ->get();

        // Hitung jumlah jurnal dan izin untuk masing-masing data Mengajar
        $rkbm = $mengajars->map(function ($mengajar) {
            return (object) [
                'mapel' => $mengajar->mapel,
                'guru' => $mengajar->guru,
                'hadir_count' => $mengajar->jurnal->count(),
                'izin_count' => $mengajar->izin->count(),
                'total' => 2 // Asumsi jumlah wajib hadir adalah 2
            ];
        });

        $pesan = "Berikut ini data dengan bulan $bulanName dan kelas $selectedKelas";

        // Return view dengan data yang diolah
        return view('rkbm.filter', compact('rkbm', 'kelas', 'pesan', 'bulanName', 'selectedKelas'));
    }


    public function exportPdf(Request $request)
    {
        $filterData = $request->only('awal', 'akhir', 'kelas');

        $rkbm = Mengajar::when(isset($filterData['awal']), function ($query) use ($filterData) {
            $query->whereDate('created_at', '>=', $filterData['awal']);
        })->when(isset($filterData['akhir']), function ($query) use ($filterData) {
            $query->whereDate('created_at', '<=', $filterData['akhir']);
        })->when(isset($filterData['kelas']), function ($query) use ($filterData) {
            $query->where('kelas_id', $filterData['kelas']);
        })->get();

        $pdf = Pdf::loadView('pdf.rkbm', compact('rkbm'));
        return $pdf->download('data_rkbm.pdf');
    }
}
