<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function data(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $guru = DB::table('guru')->paginate($perPage);
        return view('guru.data', ['guru' => $guru]);
    }

    public function add()
    {
        $guru = DB::table('guru')->get();
        return view('guru.add', ['guru' => $guru]);
    }

    public function addprocess(Request $request)
    {
        $item = new Guru();
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName); // Simpan gambar di direktori 'images'
            $item->image = $imageName;
        }

        // Hash password menggunakan bcrypt
        $hashedPassword = bcrypt($request->password);

        DB::table('guru')->insert([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $hashedPassword, // Simpan password yang di-hash
            'kelamin' => $request->kelamin,
            'foto' => $imageName,
        ]);

        return redirect('guru')->with('status', 'Guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guru = Guru::find($id);
        return view('guru.edit', compact('guru'));
    }

    public function editprocess(Request $request, $id)
    {
        $guru = DB::table('guru')->where('id', $id)->first();

        // Check if a new photo is uploaded
        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($guru->foto && file_exists(public_path('images/' . $guru->foto))) {
                unlink(public_path('images/' . $guru->foto));
            }

            // Store the new photo
            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Update the 'foto' field in the database with the new image name
            $foto = $imageName;
        } else {
            // Keep the old photo if no new photo is uploaded
            $foto = $guru->foto;
        }

        // Check if password is updated, then hash it
        $hashedPassword = $guru->password;
        if ($request->filled('password')) {
            $hashedPassword = bcrypt($request->password);
        }

        DB::table('guru')->where('id', $id)
            ->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => $hashedPassword, // Simpan password yang di-hash jika diubah
                'kelamin' => $request->kelamin,
                'foto' => $foto,
            ]);

        return redirect('guru')->with('status', 'Guru berhasil diubah');
    }

    public function delete($id)
    {
        DB::table('guru')->where('id', $id)->delete();
        return redirect('guru')->with('status', 'Guru berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new GuruImport, $request->file('file'));

        return redirect()->back()->with('status', 'Data Guru berhasil diimport!');
    }

    public function search(Request $request)
    {
        $search = $request->input('term');
        $guru = Guru::where('nama', 'LIKE', '%' . $search . '%')->get();

        return response()->json($guru);
    }

    public function profile()
    {
        $guru = Auth::guard('guru')->user();
        return view('guru.profile', compact('guru'));
    }
}

