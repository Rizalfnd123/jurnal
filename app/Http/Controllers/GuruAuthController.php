<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.guru_login'); // buat view untuk login guru
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('guru')->attempt($credentials)) {
            // Redirect jika login berhasil
            return redirect()->intended('/guru/dashboard');
        }

        // Redirect kembali jika login gagal
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        Auth::guard('guru')->logout();
        return redirect('/guru/login');
    }
}
