<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SitumpurAntrianSimpan;

class LaporanController extends Controller
{
    public function pengunjung()
    {
        $visitors = SitumpurAntrianSimpan::get();

        return view('laporan.pengunjung', ['visitors' => $visitors]);
    }
}
