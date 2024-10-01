<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TapelController extends Controller
{
    public function data()
    {
        $tapel = DB::table('tapel')->get();
        return view('tapel.data', ['tapel' => $tapel]);
    }
    public function add()
    {
        return view('tapel.add');
    }
    public function addprocess(Request $request)
    {
        DB::table('tapel')->insert([
            'tapel' => $request->tapel,
            'status' => $request->enum
        ]);
        return redirect('tapel')->with('status', 'Tahhun Pelajaran berhasil ditambahkan');
    }
    public function edit($id)
    {
        $tapel = DB::table('tapel')->where('id', $id)->first();
        return view('tapel.edit', ['tapel' => $tapel]);
    }
    public function editprocess(Request $request, $id)
    {
        DB::table('tapel')->where('id', $id)
            ->update([
                'tapel' => $request->tapel,
                'status' => $request->enum
            ]);
        return redirect('tapel')->with('status', 'Tahun Pelajaran berhasil diubah');
    }
    public function delete($id)
    {
        DB::table('tapel')->where('id', $id)->delete();
        return redirect('tapel')->with('status', 'Tahun Pelajaran berhasil dihapus');
    }
}
