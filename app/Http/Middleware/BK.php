<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BK
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Contoh kondisi: hanya izinkan jika user memiliki role 'bk'
        if (Auth::check() && Auth::user()->role === 'BK') {
            return $next($request);
        }

        // Jika kondisi tidak terpenuhi, arahkan ke halaman lain atau tampilkan pesan
        return redirect()->route('home')->with('error', 'Akses ditolak. Anda tidak memiliki izin.');
    }
}
