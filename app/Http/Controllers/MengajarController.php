<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Mengajar;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Semester;
use App\Models\Tapel;
use Illuminate\Http\Request;

class MengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mengajar = Mengajar::all();
        // return $mengajar;
        return view('mengajar.index',compact('mengajar'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mengajar = Mengajar::all();
        $kelas = Kelas::all();
        $jam =Jam::all();
        $mapel =Mapel::all();
        $semester =Semester::all();
        $guru =Guru::all();
        $tapel =Tapel::all();
        return view('mengajar.create', compact('mengajar','kelas','jam','mapel','guru','semester','tapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         Mengajar::create($request->all());
        return redirect('mengajar')->with('status','Jadwal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mengajar = Mengajar::find($id);
        return $mengajar;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mengajar = Mengajar::find($id);
        $kelas = Kelas::all();
        $jam =Jam::all();
        $mapel =Mapel::all();
        $semester =Semester::all();
        $guru =Guru::all();
        $tapel =Tapel::all();
        
        return view('mengajar.edit', compact('mengajar','kelas','jam','mapel','guru','semester','tapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mengajar = Mengajar::find($id);
        Mengajar::where('id',$mengajar->id)
        ->update([
            'hari'=> $request->hari,
            'jam_id'=> $request->jam_id,
            'kelas_id'=> $request->kelas_id,
            'mapel_id'=> $request->mapel_id,
            'semester_id'=> $request->semester_id,
            'tapel_id'=> $request->tapel_id,
            'guru_id'=> $request->guru_id
        ]);
        return redirect('mengajar')->with('status','Jadwal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mengajar = Mengajar::find($id);
        $mengajar->delete();
        return redirect('mengajar')->with('status','Jadwal berhasil dihapus');
    }
}
