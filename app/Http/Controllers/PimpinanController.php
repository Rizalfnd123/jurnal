<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function home()
    {
        return view('pimpinan.homepimpinan');
    }
}
