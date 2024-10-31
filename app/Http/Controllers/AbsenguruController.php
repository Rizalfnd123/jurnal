<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// AbsenGuruController.php
class AbsenguruController extends Controller
{
    public function store(Request $request)
    {
        // Simpan data ke tabel absensi
        DB::table('absengurus')->insert([
            'guru_id' => $request->guru_id,
            'lokasi' => $request->lokasi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return back()->with('success', 'Absensi berhasil dilakukan.');
    }
      
}
