<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SesiController extends Controller
{
    public function index()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        // Cek jika user adalah guru
        if (Auth::guard('guru')->attempt([
            'username' => $request->email,
            'password' => $request->password
        ])) {
            return redirect('/homeguru');
        }

        // Cek login untuk user lain di tabel `users`
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            // Arahkan berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect("/home");
                case 'BK':
                    return redirect("/homebk");
                case 'pimpinan':
                    return redirect("/homepimpinan");
                case 'inval':
                    return redirect("/homeinval");
                default:
                    return redirect()->route('login')->withErrors("Role tidak dikenali.");
            }
        }

        // Jika autentikasi gagal
        return redirect()->route('login')->withErrors("Email atau password tidak sesuai.");
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
