<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SitumpurCs;
use Illuminate\Http\Request;
use App\Models\MasterCustomer;
use App\Models\MasterKaryawan;
use App\Models\SitumpurDesain;
use Illuminate\Support\Facades\Auth;
use App\Models\SitumpurAntrianSimpan;
use App\Models\SitumpurAntrianCsNomor;
use App\Events\SitumpurAntrianCustomerCs;
use App\Models\SitumpurAntrianDesainNomor;
use App\Events\SitumpurAntrianCustomerDesain;
use App\Events\SitumpurAntrianCsStatusDisplay;
use App\Events\SitumpurAntrianCustomerDisplayCs;
use App\Events\SitumpurAntrianDesainStatusDisplay;
use App\Events\SitumpurAntrianCustomerDisplayDesain;

class SitumpurController extends Controller
{
    // customer 
    public function customer()
    {
        $customers = MasterCustomer::where('master_cabang_id', '2')->get();
        return view('situmpur.customer.index', ['customers' => $customers]);
    }

    public function antrianCustomer()
    {
        return view('situmpur.antrianCustomer');
    }

    public function antrianCustomerSearch(Request $request)
    {
        $customers = MasterCustomer::where('telepon', 'like', '%' . $request->value . '%')
            ->where('master_cabang_id', '2')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => 'berhasil ambil data',
            'customers' => $customers
        ]);
    }

    public function antrianCustomerStore(Request $request)
    {
        $data_customer = count(MasterCustomer::where('master_cabang_id', '2')->where('telepon', $request->telepon)->get());
        if ($data_customer == 0) {
            $customers = new MasterCustomer;
            $customers->nama_customer = $request->nama_customer;
            $customers->telepon = $request->telepon;
            $customers->master_cabang_id = '2';
            $customers->save();
        }

        $nomor_antrian = $request->nomor_antrian;
        $nama = $request->nama;
        $telepon = $request->telepon;
        $customer_filter_id = $request->customer_filter_id;
        $antrian_total = $request->nomor_antrian;

        if ($request->customer_filter_id == '3') {

            event(new SitumpurAntrianCustomerCs($nomor_antrian,$nama,$telepon,$customer_filter_id));
            event(new SitumpurAntrianCustomerDisplayCs($antrian_total));

            $antrianNomors = new SitumpurAntrianCsNomor;
            
            $antrianNomorSimpans = new SitumpurAntrianSimpan;
            $antrianNomorSimpans->jabatan = "cs";

        } else {

            event(new SitumpurAntrianCustomerDesain($nomor_antrian,$nama,$telepon,$customer_filter_id));
            event(new SitumpurAntrianCustomerDisplayDesain($antrian_total));

            $antrianNomors = new SitumpurAntrianDesainNomor;
            
            $antrianNomorSimpans = new SitumpurAntrianSimpan;
            $antrianNomorSimpans->jabatan = "desain";

        }

        $antrianNomors->nomor_antrian = $request->nomor_antrian;
        $antrianNomors->nama_customer = $request->nama_customer;
        $antrianNomors->telepon = $request->telepon;
        $antrianNomors->customer_filter_id = $request->customer_filter_id;
        $antrianNomors->save();
        
        $antrianNomorSimpans->nomor_antrian = $request->nomor_antrian;
        $antrianNomorSimpans->nama_customer = $request->nama_customer;
        $antrianNomorSimpans->telepon = $request->telepon;
        $antrianNomorSimpans->customer_filter_id = $request->customer_filter_id;
        $antrianNomorSimpans->save();

        return response()->json([
            'success' => 'data berhasil disimpan'
        ]);
    }

    public function antrianCustomerForm(Request $request, $id)
    {
        if ($id == '3') {
            $nomors = SitumpurAntrianCsNomor::orderBy('id', 'desc')->first();
            return view('situmpur.antrianCustomerFormCs', ['customer_filter_id' => $id, 'nomors' => $nomors]);
        } else {
            $nomors = SitumpurAntrianDesainNomor::orderBy('id', 'desc')->first();
            return view('situmpur.antrianCustomerFormDesain', ['customer_filter_id' => $id, 'nomors' => $nomors]);
        }
    }
    
    public function antrianCustomerDisplay()
    {
        $nomor_antrian = $request->nomor_antrian;
        $nama = $request->nama;
        $telepon = $request->telepon;
        $customer_filter_id = $request->customer_filter_id;
        $antrian_total = $request->nomor_antrian;

        if ($customer_filter_id == '3') {
            event(new SitumpurCustomerCs($nomor_antrian,$nama,$telepon,$customer_filter_id));
            event(new SitumpurCustomerCsDisplay($antrian_total));
        } else {
            event(new SitumpurCustomerDesain($nomor_antrian,$nama,$telepon,$customer_filter_id));
            event(new SitumpurCustomerDesainDisplay($antrian_total));
        } 
    }

    // cs 
    public function cs()
    {
        $cs = SitumpurCs::get();

        return view('situmpur.cs.index', ['cs' => $cs]);
    }

    public function csCreate()
    {
        $karyawans = MasterKaryawan::where('master_cabang_id', '2')->where('master_jabatan_id', '4')->get();

        return view('situmpur.cs.create', ['karyawans' => $karyawans]);
    }

    public function csStore(Request $request)
    {
        $cs = new SitumpurCs;
        $cs->nomor = $request->nomor;
        $cs->master_karyawan_id = $request->master_karyawan_id;
        $cs->created_by = Auth::user()->id;
        $cs->save();
        
        return redirect()->route('situmpur.cs')->with('status', 'Data CS berhasil ditambah');
    }

    public function csEdit($id)
    {
        $cs = SitumpurCs::find($id);
        $karyawans = MasterKaryawan::where('master_cabang_id', '2')->where('master_jabatan_id', '4')->get();

        return view('situmpur.cs.edit', ['cs' => $cs, 'karyawans' => $karyawans]);
    }

    public function csUpdate(Request $request, $id)
    {
        $cs = SitumpurCs::find($id);
        $cs->nomor = $request->nomor;
        $cs->master_karyawan_id = $request->master_karyawan_id;
        $cs->updated_by = Auth::user()->id;
        $cs->save();

        return redirect()->route('situmpur.cs')->with('status', 'Data CS berhasil diubah');
    }

    public function csDelete(Request $request, $id)
    {
        $cs = SitumpurCs::find($id);
        $cs->deleted_by = Auth::user()->id;
        $cs->save();

        $cs->delete();

        return redirect()->route('situmpur.cs')->with('status', 'Data CS berhasil dihapus');
    }

    public function antrianCs()
    {
        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->with('situmpurCs')->first();

        return view('situmpur.antrianCs', ['karyawan' => $karyawan]);
    }

    public function antrianCsNomor()
    {
        $nomors = SitumpurAntrianCsNomor::where('status', '!=', '3')->get();

        return response()->json([
            'success' => 'Success',
            'data' => $nomors
        ]);
    }

    public function antrianCsOn(Request $request, $id)
    {
        $idk = Auth::user()->master_karyawan_id;
        $karyawan = MasterKaryawan::where('id', $idk)->with('situmpurCs')->first();
        $cs_nomor = $karyawan->situmpurCs->nomor;
        $status = "on";
        $nama_cs = $karyawan->nama_panggilan;

        event(new SitumpurAntrianCsStatusDisplay($cs_nomor, $status, $nama_cs));

        $cs = SitumpurCs::find($id);
        $cs->status = "on";
        $cs->save();

        $status_cs = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->with('situmpurCs')->first();
        return redirect()->route('situmpur.antrian.cs', ['status_cs' => $status_cs]);
    }

    public function antrianCsOff(Request $request, $id)
    {
        $idk = Auth::user()->master_karyawan_id;
        $karyawan = MasterKaryawan::where('id', $idk)->with('situmpurCs')->first();
        $cs_nomor = $karyawan->situmpurCs->nomor;
        $status = "off";
        $nama_cs = "";

        event(new SitumpurAntrianCsStatusDisplay($cs_nomor, $status, $nama_cs));

        $cs = Situmpurcs::find($id);
        $cs->status = "off";
        $cs->save();

        $status_cs = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('situmpurCs')->first();
        return redirect()->route('situmpur.antrian.cs', ['status_cs' => $status_cs]);
    }

    public function antrianCsPanggil()
    {
        $antrianNomor = SitumpurAntrianCsNomor::where('nomor_antrian', $nomor)->first();
        $antrianNomor->status = 1;
        $antrianNomor->save();

        $antrian_nomor = $nomor;

        event(new SitumpurCsDisplay($antrian_nomor));

        return redirect()->route('situmpur.antrianCs');
    }

    public function antrianCsMulai($nomor)
    {
        $antrianNomor = SitumpurAntrianSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'cs')->update(['mulai' => Carbon::now()]);

        $antrianNomor = SitumpurAntrianCsNomor::where('nomor_antrian', $nomor)->first();
        $antrianNomor->status = 2;
        $antrianNomor->save();

        $antrian_nomor = $nomor;

        // event(new CsMulaiDisplay($antrian_nomor));

        return redirect()->route('situmpur.antrianCs');
    }

    public function antrianCsSelesai($nomor)
    {
        $antrianNomor = SitumpurAntrianSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'cs')->update(['selesai' => Carbon::now()]);

        $antrianNomor = SitumpurAntrianCsNomor::where('nomor_antrian', $nomor)->first();
        $antrianNomor->status = 3;
        $antrianNomor->save();

        $keterangan = "-";

        // event(new CsSelesaiDisplay($keterangan));

        return redirect()->route('situmpur.antrianCs');
    }

    // desain
    public function desain()
    {
        $desains = SitumpurDesain::get();

        return view('situmpur.desain.index', ['desains' => $desains]);
    }

    public function desainCreate()
    {
        $karyawans = MasterKaryawan::where('master_cabang_id', '2')->where('master_jabatan_id', '5')->get();

        return view('situmpur.desain.create', ['karyawans' => $karyawans]);
    }

    public function desainStore(Request $request)
    {
        $desains = new SitumpurDesain;
        $desains->nomor = $request->nomor;
        $desains->master_karyawan_id = $request->master_karyawan_id;
        $desains->created_by = Auth::user()->id;
        $desains->save();

        return redirect()->route('situmpur.desain')->with('status', 'Data desain berhasil ditambah');
    }

    public function desainEdit($id)
    {
        $desain = SitumpurDesain::find($id);
        $karyawas = MasterKaryawan::where('master_cabang_id', '2')->where('master_jabatan_id', '5')->get();

        return view('situmpur.desain.edit', ['desain' => $desain, 'karyawans' => $karyawas]);
    }

    public function desainUpdate(Request $request, $id)
    {
        $desain = SitumpurDesain::find($id);
        $desain->nomor = $request->nomor;
        $desain->master_karyawan_id = $request->master_karyawan_id;
        $desain->updated_by = Auth::user()->id;
        $desain->save();

        return redirect()->route('situmpur.desain')->with('status', 'Data berhasil diubah');
    }

    public function desainDelete(Request $request, $id)
    {
        $desain = SitumpurDesain::find($id);
        $desain->deleted_by = Auth::user()->id;
        $desain->save();

        $desain->delete();

        return redirect()->route('situmpur.desain')->with('status', 'Data berhasil diubah');
    }

    public function antrianDesain()
    {
        
        $karyawan = MasterKaryawan::where('id', Auth::user()->master_karyawan_id)->with('situmpurDesain')->first();

        return view('situmpur.antrianDesain', ['karyawan' => $karyawan]);
    }

    public function antrianDesainNomor()
    {
        $nomors = SitumpurAntrianDesainNomor::where('status', '!=', '3')->get();

        return response()->json([
            'success' => 'Success',
            'data' => $nomors
        ]);
    }

    public function antrianDesainOn(Request $request, $id)
    {
        $idk = Auth::user()->master_karyawan_id;
        $karyawan = MasterKaryawan::where('id', $idk)->with('situmpurDesain')->first();
        $desain_nomor = $karyawan->situmpurDesain->nomor;
        $status = "on";
        $nama_desain = $karyawan->nama_panggilan;

        event(new SitumpurAntrianDesainStatusDisplay($desain_nomor, $status, $nama_desain));

        $desainer = SitumpurDesain::find($id);
        $desainer->status = "on";
        $desainer->save();

        $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('situmpurDesain')->first();
        return redirect()->route('situmpur.antrian.desain', ['status_desainer' => $status_desainer]);
    }

    public function antrianDesainOff(Request $request, $id)
    {
        $idk = Auth::user()->master_karyawan_id;
        $karyawan = MasterKaryawan::where('id', $idk)->with('situmpurDesain')->first();
        $desain_nomor = $karyawan->situmpurDesain->nomor;
        $status = "off";
        $nama_desain = "";

        event(new SitumpurAntrianDesainStatusDisplay($desain_nomor, $status, $nama_desain));

        $desainer = SitumpurDesain::find($id);
        $desainer->status = "off";
        $desainer->save();

        $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('situmpurDesain')->first();
        return redirect()->route('situmpur.antrian.desain', ['status_desainer' => $status_desainer]);
    }

    public function antrianDesainPanggil($nomor)
    {
        $antrianNomor = SitumpurAntrianDesainNomor::where('nomor_antrian', $nomor)->first();
        $antrianNomor->status = 1;
        $antrianNomor->save();

        $antrian_nomor = $nomor;

        event(new SitumpurDesainDisplay($antrian_nomor));

        $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
        return redirect()->route('situmpur.antrianDesain', ['status_desainer' => $status_desainer]);
    }

    public function antrianDesainUpdate(Request $request)
    {
        if ($request->jenis == "desain") {
            $antrianNomor = SitumpurAntrianDesainNomor::where('nomor_antrian', $request->nomor)->first();
            $antrianNomor->customer_filter_id = 4;
            $antrianNomor->save();
    
            $antrianNomorSimpan = SitumpurAntrianSimpan::where('nomor_antrian', $request->nomor)->first();
            $antrianNomorSimpan->customer_filter_id = 4;
            $antrianNomorSimpan->save();
        } else {
            $antrianNomor = SitumpurAntrianDesainNomor::where('nomor_antrian', $request->nomor)->first();
            $antrianNomor->customer_filter_id = 5;
            $antrianNomor->save();

            $antrianNomorSimpan = SitumpurAntrianSimpan::where('nomor_antrian', $request->nomor)->first();
            $antrianNomorSimpan->customer_filter_id = 5;
            $antrianNomorSimpan->save();
        }

      $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
      return redirect()->route('situmpur.antrianDesainer', ['status_desainer' => $status_desainer]);
    }

    public function antrianDesainMulai($nomor)
    {
        $antrianNomor = SitumpurAntrianSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'desainer')->update(['mulai' => Carbon::now()]);

        $antrianNomor = SitumpurAntrianDesainNomor::where('nomor_antrian', $nomor)->first();
        $antrianNomor->status = 2;
        $antrianNomor->save();

        $idk = Auth::user()->karyawan_id;
        $karyawan = MasterKaryawan::where('id', $idk)->with('desainer')->first();
        $desain_nomor = $karyawan->desainer->title;

        $antrian_nomor = $nomor;

        event(new SitumpurDesainMulaiDisplay($desain_nomor,$antrian_nomor));

        $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
        return redirect()->route('situmpur.antrianDesainer', ['status_desainer' => $status_desainer]);
    }

    public function antrianDesainSelesai($nomor)
    {
        $antrianNomor = SitumpurAntrianSimpan::where('nomor_antrian', $nomor)->where('jabatan', 'desainer')->update(['selesai' => Carbon::now()]);

        $antrianNomor = SitumpurAntrianDesainNomor::where('nomor_antrian', $nomor)->first();
        $antrianNomor->status = 3;
        $antrianNomor->save();

        $idk = Auth::user()->karyawan_id;
        $karyawan = MasterKaryawan::where('id', $idk)->with('desainer')->first();
        $desain_nomor = $karyawan->desainer->title;

        $keterangan = "free";

        event(new SitumpurDesainSelesaiDisplay($desain_nomor,$keterangan));

        $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
        return redirect()->route('situmpur.antrianDesainer', ['status_desainer' => $status_desainer]);
    }

    // display 
    public function antrianDisplay()
    {
        return view('situmpur.antrianDisplay');
    }
}
