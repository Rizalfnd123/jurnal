<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Mengajar;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $izin = Izin::with(['guru', 'mapel', 'kelas'])->get();
        return view('izin.index', compact('izin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $izin = izin::all();
        $kelas = Kelas::all();
        $mapel =Mapel::all();
        $guru =Guru::all();
        $jadwal = Mengajar::find($id);
        return view('izin.create', compact('izin','kelas','mapel','guru','jadwal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Izin::create($request->all());
        $mengajar = Mengajar::find($request->mengajar_id);
        if ($mengajar) { 
            $mengajar->status = 'I'; // Ubah status menjadi 'S'
            $mengajar->save();
        }
        return redirect('izin')->with('status','izin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $izin = izin::find($id);
        return $izin;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $izin = izin::find($id);
        $kelas = Kelas::all();
        $mapel =Mapel::all();
        $guru =Guru::all();
        
        return view('izin.edit', compact('izin','kelas','mapel','guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $izin = izin::find($id);
        izin::where('id',$izin->id)
        ->update([
            'tanggal'=> $request->tanggal,
            'kelas_id'=> $request->kelas_id,
            'mapel_id'=> $request->mapel_id,
            'guru_id'=> $request->guru_id,
            'ket'=> $request->ket,
            'surat'=> $request->surat,
            'kegiatan'=> $request->kegiatan,
            'lampiran'=> $request->lampiran,
        ]);
        return redirect('izin')->with('status','Jadwal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $izin = izin::find($id);
        $izin->delete();
        return redirect('izin')->with('status','izin berhasil dihapus');
    }
}
