<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ], [
        'email.required' => 'Email wajib diisi',
        'password.required' => 'Password wajib diisi'
    ]);

    $credentials = [
        'email' => $request->email,
        'password' => $request->password
    ];
    $gcredentials = [
        'username' => $request->email,
        'password' => $request->password
    ];

    if (Auth::attempt($credentials)) {
        // Cek role user setelah login
        if (Auth::user()->role == 'admin') {
            return redirect("/home");
        } elseif (Auth::user()->role == 'BK') {
            return redirect("/homebk"); // arahkan ke halaman khusus BK
        } else {
            return redirect("/homeguru");
        }
    } elseif (Auth::guard('guru')->attempt($gcredentials)) {
        return redirect('/homeguru');
    } else {
        // Tambahkan log atau pesan untuk membantu diagnosis
        return redirect()->route('login')->withErrors("Email dan password tidak sesuai.");
    }
}

public function logout()
{
    if (Auth::guard('guru')->check()) {
        Auth::guard('guru')->logout();
    } else {
        Auth::logout();
    }

    return redirect()->route('login');
}

}
