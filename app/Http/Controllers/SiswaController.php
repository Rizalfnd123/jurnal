<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Siswas;

class SiswaController extends Controller
{
    public function import()
    {
        return view('siswas.import');
    }

    public function importPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->back()->with('status', 'Data siswa berhasil diimport!');
    }
}
