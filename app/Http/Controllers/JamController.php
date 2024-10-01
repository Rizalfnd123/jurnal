<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class JamController extends Controller
{
    public function data()
    {
        $jam = DB::table('jam')->get();
        return view('jam.data', ['jam' => $jam]);
    }
    public function add()
    {
        return view('jam.add');
    }
    public function addprocess(Request $request)
    {
        DB::table('jam')->insert([
            'jam' => $request->jam
        ]);
        return redirect('jam')->with('status', 'jam berhasil ditambahkan');
    }
    public function edit($id)
    {
        $jam=DB::table('jam')->where('id',$id)->first();
        return view('jam.edit', ['jam' =>$jam]);
    }
    public function editprocess(Request $request,$id)
    {
        DB::table('jam')->where('id',$id)
        ->update([
            'jam' => $request->jam
        ]);
        return redirect('jam')->with('status', 'jam berhasil diubah');
    }
    public function delete($id)
    {
        DB::table('jam')->where('id',$id)->delete();
        return redirect('jam')->with('status', 'jam berhasil dihapus');
    }
}
