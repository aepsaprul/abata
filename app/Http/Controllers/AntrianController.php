<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\AntrianNomor;
use Illuminate\Http\Request;
use App\Models\AntrianNomorSave;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function customer()
    {
        return view('antrian.customer');
    }
    public function customerStore(Request $request)
    {
        $countAntrianNomors = DB::table('antrian_nomors')->count();

        $customers = new Customer;
        $customers->nama = $request->nama;
        $customers->telepon = $request->telepon;
        $customers->save();

        $antrianNomors = new AntrianNomor;
        $antrianNomors->nomor_antrian = $countAntrianNomors + 1;
        $antrianNomors->nama = $request->nama;
        $antrianNomors->telepon = $request->telepon;
        $antrianNomors->customer_filter_id = $request->btnfile;
        $antrianNomors->save();
        
        $antrianNomorSaves = new AntrianNomorSave;
        $antrianNomorSaves->nomor_antrian = $countAntrianNomors + 1;
        $antrianNomorSaves->nama = $request->nama;
        $antrianNomorSaves->telepon = $request->telepon;
        $antrianNomorSaves->customer_filter_id = $request->btnfile;
        $antrianNomorSaves->save();

        return response()->json([
            'success' => 'data berhasil disimpan'
        ]);
    }
    public function customerNomor()
    {
        $nomors = AntrianNomor::get();

        return response()->json([
            'success' => 'Success',
            'nomors' => $nomors
        ]);
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
