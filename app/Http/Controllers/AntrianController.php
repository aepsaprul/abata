<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function customer()
    {
        return view('antrian.customer');
    }

    public function cs()
    {
        return view('antrian.cs');
    }

    public function desainer()
    {
        return view('antrian.desainer');
    }

    public function display()
    {
        return view('antrian.display');
    }
}
