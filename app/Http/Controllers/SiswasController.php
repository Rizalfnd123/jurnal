<?php

namespace App\Http\Controllers;

use App\Models\Siswas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswas::paginate(15);
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
        // Validasi input
        $request->validate([
            'nis' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'status' => 'required|in:aktif,tidak aktif',
        ]);


        // Simpan data siswa
        $siswa = new Siswas();
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->kelamin = $request->kelamin;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->status = $request->status;
        $siswa->save();

        return redirect()->back()->with('success', 'Data siswa berhasil disimpan.');
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

        return view('siswas.edit', compact('siswas', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $siswas = Siswas::find($id);
        Siswas::where('id', $siswas->id)
            ->update([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'kelamin' => $request->kelamin,
                'kelas_id' => $request->kelas_id,
                'status' => $request->status
            ]);
        return redirect('siswas')->with('status', 'Siswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswas = Siswas::find($id);
        $siswas->delete();
        return redirect('siswas')->with('status', 'Siswa berhasil dihapus');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv', // Validasi file harus xlsx atau csv
        ]);
        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return redirect()->back()->with('status', 'Data berhasil diimpor');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}
