<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $guru = Auth::guard('guru')->user(); 
        // Anda bisa menambahkan logika untuk mengambil data pengguna jika diperlukan
        return view('profil', compact('guru')); // Pastikan view ini ada di folder resources/views
    }
}
