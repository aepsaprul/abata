<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SitumpurAntrianSimpan;

class DashboardController extends Controller
{
    public function index()
    {
        $jmlPengunjungHariIni = count(SitumpurAntrianSimpan::get());
        return view('dashboard', ['jmlPengunjungHariIni' => $jmlPengunjungHariIni]);
    }
    public function jmlPengunjungHariIni()
    {
        $jmlPengunjungHariIni = SitumpurAntrianSimpan::get();
    }
}
