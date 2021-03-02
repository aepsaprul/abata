<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AntrianPengunjung;

class LaporanController extends Controller
{
    public function pengunjung()
    {
        return view('laporan.pengunjung');
    }
    public function pengunjungData()
    {
        $visitors = AntrianPengunjung::where('status', '1')->get();

        return response()->json([
            'visitors' => $visitors
        ]);
    }
}
