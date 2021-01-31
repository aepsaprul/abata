<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Events\CustomerCs;
use Illuminate\Http\Request;
use App\Events\CustomerDesain;
use App\Models\AntrianNomorCs;
use App\Models\AntrianNomorSave;
use App\Models\AntrianNomorCsSave;
use App\Models\AntrianNomorDesain;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AntrianNomorDesainSave;

class AntrianController extends Controller
{
    public function customer()
    {
      return view('antrian.customer');
    }
    public function customerStore(Request $request)
    {
      $customers = new Customer;
      $customers->nama = $request->nama;
      $customers->telepon = $request->telepon;
      $customers->save();

      if ($request->customer_filter_id == '3') {

        $antrianNomors = new AntrianNomorCs;
        
        $antrianNomorSaves = new AntrianNomorCsSave;

      } else {

        $antrianNomors = new AntrianNomorDesain;
        
        $antrianNomorSaves = new AntrianNomorDesainSave;

      }

      
      $antrianNomors->nomor_antrian = $request->nomor_antrian;
      $antrianNomors->nama = $request->nama;
      $antrianNomors->telepon = $request->telepon;
      $antrianNomors->customer_filter_id = $request->customer_filter_id;
      $antrianNomors->save();
      
      $antrianNomorSaves->nomor_antrian = $request->nomor_antrian;
      $antrianNomorSaves->nama = $request->nama;
      $antrianNomorSaves->telepon = $request->telepon;
      $antrianNomorSaves->customer_filter_id = $request->customer_filter_id;
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

    public function customerSender(Request $request)
    {
      $nomor_antrian = $request->nomor_antrian;
      $nama = $request->nama;
      $telepon = $request->telepon;
      $customer_filter_id = $request->customer_filter_id;

      if ($customer_filter_id == '3') {
        event(new CustomerCs($nomor_antrian,$nama,$telepon,$customer_filter_id));
      } else {
        event(new CustomerDesain($nomor_antrian,$nama,$telepon,$customer_filter_id));
      }      
    }

    public function customerForm(Request $request, $id)
    {
      if ($id == '3') {
        $nomors = AntrianNomorCs::orderBy('id', 'desc')->first();
      } else {
        $nomors = AntrianNomorDesain::orderBy('id', 'desc')->first();
      }
      
      return view('antrian.customerForm', ['customer_filter_id' => $id, 'nomors' => $nomors]);
    }

    public function customerSiapCetak(Request $request)
    {

    }

    public function customerDesain(Request $request)
    {

    }

    public function customerKonsultasi(Request $request)
    {

    }

    public function cs()
    {
        return view('antrian.cs');
    }
    public function csNomor(Request $request)
    {
      $nomors = AntrianNomorCs::get();

      return response()->json([
          'success' => 'Success',
          'data' => $nomors
      ]);
    }

    public function desainer()
    {
      return view('antrian.desainer');
    }
    public function desainerNomor()
    {
      $nomors = AntrianNomorDesain::get();

      return response()->json([
          'success' => 'Success',
          'data' => $nomors
      ]);
    }

    public function display()
    {
      return view('antrian.display');
    }
}
