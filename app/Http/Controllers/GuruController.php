<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function data()
    {
        $guru = DB::table('guru')->get();
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
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName); // Simpan gambar di direktori 'images'
            $item->image = $imageName;
        }
        DB::table('guru')->insert([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'kelamin' => $request->kelamin,
            'foto' => $imageName,
        ]);
        return redirect('guru')->with('status', 'guru berhasil ditambahkan');
    }
    public function edit($id)
    {$guru = Guru::find($id);
        return view('guru.edit', compact('guru'));
        
    }
    public function editprocess(Request $request,$id)
    {
        $guru = DB::table('guru')->where('id', $id)->first();

    // Check if a new photo is uploaded
    if ($request->hasFile('foto')) {
        // Delete the old photo if it exists
        if ($guru->foto && file_exists(public_path('images/'.$guru->foto))) {
            unlink(public_path('images/'.$guru->foto));
        }

        // Store the new photo
        $image = $request->file('foto');
        $imageName = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        // Update the 'foto' field in the database with the new image name
        $foto = $imageName;
    } else {
        // Keep the old photo if no new photo is uploaded
        $foto = $guru->foto;
    }

    DB::table('guru')->where('id', $id)
        ->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password, // Make sure to hash the password if it's not already hashed
            'kelamin' => $request->kelamin,
            'foto' => $foto,
        ]);

    return redirect('guru')->with('status', 'Guru berhasil diubah');
    }
    public function delete($id)
    {
        DB::table('guru')->where('id',$id)->delete();
        return redirect('guru')->with('status', 'guru berhasil dihapus');
    }
}
