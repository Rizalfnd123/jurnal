<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function data()
    {
        $semester = DB::table('semester')->get();
        return view('semester.data', ['semester' => $semester]);
    }
    public function add()
    {
        return view('semester.add');
    }
    public function addprocess(Request $request)
    {
        DB::table('semester')->insert([
            'semester' => $request->semester,
            'status' => $request->enum
        ]);
        return redirect('semester')->with('status', 'semester berhasil ditambahkan');
    }
    public function edit($id)
    {
        $semester = DB::table('semester')->where('id', $id)->first();
        return view('semester.edit', ['semester' => $semester]);
    }
    public function editprocess(Request $request, $id)
    {
        DB::table('semester')->where('id', $id)
            ->update([
                'semester' => $request->semester,
                'status' => $request->enum
            ]);
        return redirect('semester')->with('status', 'semester berhasil diubah');
    }
    public function delete($id)
    {
        DB::table('semester')->where('id', $id)->delete();
        return redirect('semester')->with('status', 'semester berhasil dihapus');
    }
}
