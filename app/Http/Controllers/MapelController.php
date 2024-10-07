<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function data()
    {
        $mapel = DB::table('mapel')->get();
        return view('mapel.data', ['mapel' => $mapel]);
    }
    public function add()
    {
        return view('mapel.add');
    }
    public function addprocess(Request $request)
    {
        DB::table('mapel')->insert([
            'mapel' => $request->mapel
        ]);
        return redirect('mapel')->with('status', 'mapel berhasil ditambahkan');
    }
    public function edit($id)
    {
        $mapel = DB::table('mapel')->where('id', $id)->first();
        return view('mapel.edit', ['mapel' => $mapel]);
    }
    public function editprocess(Request $request, $id)
    {
        DB::table('mapel')->where('id', $id)
            ->update([
                'mapel' => $request->mapel
            ]);
        return redirect('mapel')->with('status', 'mapel berhasil diubah');
    }
    public function delete($id)
    {
        DB::table('mapel')->where('id', $id)->delete();
        return redirect('mapel')->with('status', 'mapel berhasil dihapus');
    }
    public function search(Request $request)
    {
        $search = $request->input('term');
        $mapel = Mapel::where('mapel', 'LIKE', '%' . $search . '%')->get();

        return response()->json($mapel);
    }
}
