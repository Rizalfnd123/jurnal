<?php

namespace App\Http\Controllers;

use App\Models\Siswas;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswas::all();
        // return $siswas;
        return view('siswas.index', ['siswas' => $siswas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('siswas.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Siswas::create($request->all());
        return redirect('siswas')->with('status','Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswas = Siswas::find($id);
        return $siswas;
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswas = Siswas::find($id);
        $kelas = Kelas::all();
        
        return view('siswas.edit', compact('siswas','kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $siswas = Siswas::find($id);
        Siswas::where('id',$siswas->id)
        ->update([
            'nis'=> $request->nis,
            'nama'=> $request->nama,
            'kelamin'=> $request->kelamin,
            'kelas_id'=> $request->kelas_id,
            'status'=> $request->status
        ]);
        return redirect('siswas')->with('status','Siswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswas = Siswas::find($id);
        $siswas->delete();
        return redirect('siswas')->with('status','Siswa berhasil dihapus');
    }
    
}
