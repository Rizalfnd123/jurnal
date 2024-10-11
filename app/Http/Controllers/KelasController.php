<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function data()
    {
        $kelas = Kelas::paginate(10); // Ambil 10 data per halaman

        return view('kelas.data', ['kelas' => $kelas]);
    }
    public function add()
    {
        return view('kelas.add');
    }
    public function addprocess(Request $request)
    {
        DB::table('kelas')->insert([
            'kelas' => $request->kelas
        ]);
        return redirect('kelas')->with('status', 'kelas berhasil ditambahkan');
    }
    public function edit($id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();
        return view('kelas.edit', ['kelas' => $kelas]);
    }
    public function editprocess(Request $request, $id)
    {
        DB::table('kelas')->where('id', $id)
            ->update([
                'kelas' => $request->kelas
            ]);
        return redirect('kelas')->with('status', 'kelas berhasil diubah');
    }
    public function delete($id)
    {
        DB::table('kelas')->where('id', $id)->delete();
        return redirect('kelas')->with('status', 'kelas berhasil dihapus');
    }
    public function search(Request $request)
    {
        $search = $request->input('term');
        $kelas = Kelas::where('kelas', 'LIKE', '%' . $search . '%')->get();

        return response()->json($kelas);
    }
    public function getKelasByTapel($tapel_id)
{
    $kelas = Kelas::where('tapel_id', $tapel_id)->pluck('nama_kelas', 'id');
    return response()->json($kelas);
}

}
