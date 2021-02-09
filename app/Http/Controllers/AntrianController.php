<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Desainer;
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
use App\Events\DesainMulaiDisplay;
use App\Models\AntrianNomorCsSave;
use App\Models\AntrianNomorDesain;
use App\Models\AntrianNomorSimpan;
use Illuminate\Support\Facades\DB;
use App\Events\DesainSelesaiDisplay;
use Illuminate\Support\Facades\Auth;
use App\Events\CustomerDesainDisplay;
use App\Models\AntrianNomorDesainSave;

class AntrianController extends Controller
{
    public function customer()
    {
      return view('antrian.customer');
    }
    public function customerData(Request $request)
    {
      $customers = Customer::where('telepon', 'like', '%' . $request->value . '%')->limit(5)->get();

      return response()->json([
        'success' => 'berhasil ambil data',
        'customers' => $customers
      ]);
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

      // event(new CsMulaiDisplay($antrian_nomor));

      return redirect()->route('antrian.cs');
    }
    public function csSelesai($nomor)
    {
      $antrianNomor = AntrianNomorSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'cs')->update(['selesai' => Carbon::now()]);

      $antrianNomor = AntrianNomorCs::where('nomor_antrian', $nomor)->first();
      $antrianNomor->status = 3;
      $antrianNomor->save();

      $keterangan = "free";

      // event(new CsSelesaiDisplay($keterangan));

      return redirect()->route('antrian.cs');
    }

    public function desainer()
    {
      $status_desainer = Karyawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return view('antrian.desainer', ['status_desainer' => $status_desainer]);
    }
    public function desainerOn(Request $request, $id)
    {
      $idk = Auth::user()->karyawan_id;
      $karyawan = Karyawan::where('id', $idk)->with('desainer')->first();
      $desain_nomor = $karyawan->desainer->title;
      $status = "on";
      
      event(new DesainStatus($desain_nomor, $status));

      $desainer = Desainer::find($id);
      $desainer->status = "on";
      $desainer->save();

      $status_desainer = Karyawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return redirect()->route('antrian.desainer', ['status_desainer' => $status_desainer]);
    }
    public function desainerOff(Request $request, $id)
    {
      $idk = Auth::user()->karyawan_id;
      $karyawan = Karyawan::where('id', $idk)->with('desainer')->first();
      $desain_nomor = $karyawan->desainer->title;
      $status = "off";
      
      event(new DesainStatus($desain_nomor, $status));

      $desainer = Desainer::find($id);
      $desainer->status = "off";
      $desainer->save();

      $status_desainer = Karyawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return redirect()->route('antrian.desainer', ['status_desainer' => $status_desainer]);
    }
    public function desainerNomor()
    {
      $nomors = AntrianNomorDesain::where('status', '!=', '3')->get();

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

      $status_desainer = Karyawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return redirect()->route('antrian.desainer', ['status_desainer' => $status_desainer]);
    }
    public function desainerUpdateDesain($nomor)
    {
      $antrianNomor = AntrianNomorDesain::where('nomor_antrian', $nomor)->first();
      $antrianNomor->customer_filter_id = 4;
      $antrianNomor->save();

      $antrianNomorSimpan = AntrianNomorSimpan::where('nomor_antrian', $nomor)->first();
      $antrianNomorSimpan->customer_filter_id = 4;
      $antrianNomorSimpan->save();

      $status_desainer = Karyawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return redirect()->route('antrian.desainer', ['status_desainer' => $status_desainer]);
    }
    public function desainerUpdateEdit($nomor)
    {
      $antrianNomor = AntrianNomorDesain::where('nomor_antrian', $nomor)->first();
      $antrianNomor->customer_filter_id = 5;
      $antrianNomor->save();

      $antrianNomorSimpan = AntrianNomorSimpan::where('nomor_antrian', $nomor)->first();
      $antrianNomorSimpan->customer_filter_id = 5;
      $antrianNomorSimpan->save();

      $status_desainer = Karyawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return redirect()->route('antrian.desainer', ['status_desainer' => $status_desainer]);
    }
    public function desainerMulai($nomor)
    {
      $antrianNomor = AntrianNomorSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'desainer')->update(['mulai' => Carbon::now()]);

      $antrianNomor = AntrianNomorDesain::where('nomor_antrian', $nomor)->first();
      $antrianNomor->status = 2;
      $antrianNomor->save();

      $idk = Auth::user()->karyawan_id;
      $karyawan = Karyawan::where('id', $idk)->with('desainer')->first();
      $desain_nomor = $karyawan->desainer->title;

      $antrian_nomor = $nomor;

      event(new DesainMulaiDisplay($desain_nomor,$antrian_nomor));

      $status_desainer = Karyawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return redirect()->route('antrian.desainer', ['status_desainer' => $status_desainer]);
    }
    public function desainerSelesai($nomor)
    {
      $antrianNomor = AntrianNomorSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'desainer')->update(['selesai' => Carbon::now()]);

      $antrianNomor = AntrianNomorDesain::where('nomor_antrian', $nomor)->first();
      $antrianNomor->status = 3;
      $antrianNomor->save();

      $idk = Auth::user()->karyawan_id;
      $karyawan = Karyawan::where('id', $idk)->with('desainer')->first();
      $desain_nomor = $karyawan->desainer->title;

      $keterangan = "free";

      event(new DesainSelesaiDisplay($desain_nomor,$keterangan));

      $status_desainer = Karyawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return redirect()->route('antrian.desainer', ['status_desainer' => $status_desainer]);
    }

    public function display()
    {
      return view('antrian.display');
    }
}
