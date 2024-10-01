<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Mengajar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurnal = Jurnal::with(['guru', 'mapel', 'kelas'])->get();
        return view('jurnal.index', compact('jurnal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $jurnal = Jurnal::all();
        $kelas = Kelas::all();
        $mapel =Mapel::all();
        $guru =Guru::all();
        $jadwal = Mengajar::find($id); // Pastikan $id sesuai dengan yang diterima dari request atau route
        $absensi = Jurnal::where('mengajar_id', $jadwal->id)->first();
        return view('jurnal.create', compact('jurnal','kelas','mapel','guru','jadwal','absensi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Jurnal::create($request->all());
        $mengajar = Mengajar::find($request->mengajar_id);
        if ($mengajar) { 
            $mengajar->status = 'S'; // Ubah status menjadi 'S'
            $mengajar->save();
        }
        
        return redirect('jurnal')->with('status','Jurnal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jurnal = Jurnal::find($id);
        return $jurnal;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $jurnal = jurnal::find($id);
        $kelas = Kelas::all();
        $mapel =Mapel::all();
        $guru =Guru::all();
        
        return view('jurnal.edit', compact('jurnal','kelas','mapel','guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jurnal = jurnal::find($id);
        jurnal::where('id',$jurnal->id)
        ->update([
            'tanggal'=> $request->tanggal,
            'kelas_id'=> $request->kelas_id,
            'mapel_id'=> $request->mapel_id,
            'guru_id'=> $request->guru_id,
            'materi'=> $request->materi,
            'hadir'=> $request->hadir,
            'tidak_hadir'=> $request->tidak_hadir,
            'dokumentasi'=> $request->dokumentasi,
        ]);
        return redirect('jurnal')->with('status','Jadwal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $jurnal = Jurnal::find($id);
        $jurnal->delete();
        return redirect('jurnal')->with('status','Jurnal berhasil dihapus');
    }
}
