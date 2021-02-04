<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Karyawan;
use App\Events\CsDisplay;
use App\Events\CustomerCs;
use App\Events\DesainStatus;
use Illuminate\Http\Request;
use App\Events\DesainDisplay;
use App\Events\CsMulaiDisplay;
use App\Events\CustomerDesain;
use App\Models\AntrianNomorCs;
use App\Events\CsSelesaiDisplay;
use App\Models\AntrianNomorSave;
use App\Events\CustomerCsDisplay;
use App\Models\AntrianNomorCsSave;
use App\Models\AntrianNomorDesain;
use App\Models\AntrianNomorSimpan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\CustomerDesainDisplay;
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
        
        $antrianNomorSimpans = new AntrianNomorSimpan;
        $antrianNomorSimpans->jabatan = "cs";

      } else {

        $antrianNomors = new AntrianNomorDesain;
        
        $antrianNomorSimpans = new AntrianNomorSimpan;
        $antrianNomorSimpans->jabatan = "desain";

      }

      
      $antrianNomors->nomor_antrian = $request->nomor_antrian;
      $antrianNomors->nama = $request->nama;
      $antrianNomors->telepon = $request->telepon;
      $antrianNomors->customer_filter_id = $request->customer_filter_id;
      $antrianNomors->save();
      
      $antrianNomorSimpans->nomor_antrian = $request->nomor_antrian;
      $antrianNomorSimpans->nama = $request->nama;
      $antrianNomorSimpans->telepon = $request->telepon;
      $antrianNomorSimpans->customer_filter_id = $request->customer_filter_id;
      $antrianNomorSimpans->save();

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
      $antrian_total = $request->nomor_antrian;

      if ($customer_filter_id == '3') {
        event(new CustomerCs($nomor_antrian,$nama,$telepon,$customer_filter_id));
        event(new CustomerCsDisplay($antrian_total));
      } else {
        event(new CustomerDesain($nomor_antrian,$nama,$telepon,$customer_filter_id));
        event(new CustomerDesainDisplay($antrian_total));
      }      
    }

    public function customerForm(Request $request, $id)
    {
      if ($id == '3') {
        $nomors = AntrianNomorCs::orderBy('id', 'desc')->first();
        return view('antrian.customerFormCs', ['customer_filter_id' => $id, 'nomors' => $nomors]);
      } else {
        $nomors = AntrianNomorDesain::orderBy('id', 'desc')->first();
        return view('antrian.customerFormDesain', ['customer_filter_id' => $id, 'nomors' => $nomors]);
      }
    }

    public function cs()
    {
        return view('antrian.cs');
    }
    public function csNomor(Request $request)
    {
      $nomors = AntrianNomorCs::where('status', '!=', '3')->get();

      return response()->json([
          'success' => 'Success',
          'data' => $nomors
      ]);
    }
    public function csPanggil($nomor)
    {
      $antrianNomor = AntrianNomorCs::where('nomor_antrian', $nomor)->first();
      $antrianNomor->status = 1;
      $antrianNomor->save();

      $antrian_nomor = $nomor;

      event(new CsDisplay($antrian_nomor));

      return redirect()->route('antrian.cs');
    }
    public function csMulai($nomor)
    {
      $antrianNomor = AntrianNomorSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'cs')->update(['mulai' => Carbon::now()]);

      $antrianNomor = AntrianNomorCs::where('nomor_antrian', $nomor)->first();
      $antrianNomor->status = 2;
      $antrianNomor->save();

      $antrian_nomor = $nomor;

      event(new CsMulaiDisplay($antrian_nomor));

      return redirect()->route('antrian.cs');
    }
    public function csSelesai($nomor)
    {
      $antrianNomor = AntrianNomorSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'cs')->update(['selesai' => Carbon::now()]);

      $antrianNomor = AntrianNomorCs::where('nomor_antrian', $nomor)->first();
      $antrianNomor->status = 3;
      $antrianNomor->save();

      $keterangan = "free";

      event(new CsSelesaiDisplay($keterangan));

      return redirect()->route('antrian.cs');
    }

    public function desainer()
    {
      return view('antrian.desainer');
    }
    public function desainerOn()
    {
      $id = Auth::user()->karyawan_id;
      $karyawan = Karyawan::where('id', $id)->with('desainer')->first();
      $status = $karyawan->desainer->title;
      
      event(new DesainStatus($status));
    }
    public function desainerNomor()
    {
      $nomors = AntrianNomorDesain::get();

      return response()->json([
          'success' => 'Success',
          'data' => $nomors
      ]);
    }
    public function desainerPanggil($nomor)
    {
      $antrianNomor = AntrianNomorDesain::where('nomor_antrian', $nomor)->first();
      $antrianNomor->status = 1;
      $antrianNomor->save();

      $antrian_nomor = $nomor;

      event(new DesainDisplay($antrian_nomor));

      return redirect()->route('antrian.desainer');
    }
    public function desainerUpdateDesain($nomor)
    {
      $antrianNomor = AntrianNomorDesain::where('nomor_antrian', $nomor)->first();
      $antrianNomor->customer_filter_id = 4;
      $antrianNomor->save();

      $antrianNomorSimpan = AntrianNomorSimpan::where('nomor_antrian', $nomor)->first();
      $antrianNomorSimpan->customer_filter_id = 4;
      $antrianNomorSimpan->save();

      return redirect()->route('antrian.desainer');
    }
    public function desainerUpdateEdit($nomor)
    {
      $antrianNomor = AntrianNomorDesain::where('nomor_antrian', $nomor)->first();
      $antrianNomor->customer_filter_id = 5;
      $antrianNomor->save();

      $antrianNomorSimpan = AntrianNomorSimpan::where('nomor_antrian', $nomor)->first();
      $antrianNomorSimpan->customer_filter_id = 5;
      $antrianNomorSimpan->save();

      return redirect()->route('antrian.desainer');
    }

    public function display()
    {
      return view('antrian.display');
    }
}
