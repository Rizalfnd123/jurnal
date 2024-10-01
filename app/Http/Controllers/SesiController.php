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
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            if(Auth::user()->role == 'admin'){
                return redirect("/home");
            } elseif(Auth::user()->role == 'guru'){
                return redirect("/homeguru");
            }
        } else {
            return redirect("")->withErrors("Username dan password yang dimasukkan tidak sesuai")->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return view('');
    }
}
