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
        $antrianPengungjung = AntrianPengunjung::where('status', '!=', 0)->with('masterKaryawan')->get();
        $mapAntrian = $antrianPengungjung->map(function ($item, $key) {
            return [
                'id' => $key + 1,
                'nama_customer' => $item->nama_customer,
                'telepon' => $item->telepon,
                'customer_filter_id' => $item->customer_filter_id,
                'master_karyawan_id' => $item->master_karyawan_id,
                'nama_karyawan' => $item->masterKaryawan->nama_lengkap,
                'tanggal' => $item->tanggal,
                'master_cabang_id' => $item->master_cabang_id
            ];
        });
        return datatables ($mapAntrian)->toJson();
    }
}
