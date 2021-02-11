<?php

namespace App\Http\Controllers;

use App\Models\SitumpurCs;
use Illuminate\Http\Request;
use App\Models\MasterCustomer;
use App\Models\SitumpurAntrianSimpan;
use App\Models\SitumpurAntrianCsNomor;
use App\Models\SitumpurAntrianDesainNomor;

class SitumpurController extends Controller
{
    // customer 
    public function customer()
    {
        $customers = MasterCustomer::where('cabang_id', '2')->get();
        return view('situmpur.customer.index', ['customers' => $customers]);
    }

    public function antrianCustomer()
    {
        return view('situmpur.antrianCustomer');
    }

    public function antrianCustomerSearch(Request $request)
    {
        $customers = MasterCustomer::where('telepon', 'like', '%' . $request->value . '%')
            ->where('cabang_id', '2')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => 'berhasil ambil data',
            'customers' => $customers
        ]);
    }

    public function antrianCustomerStore(Request $request)
    {
        $data_customer = MasterCustomer::where('cabang_id', '2')
            ->get();
        if ($data_customer->telepon != $request->telepon) {
            $customers = new MasterCustomer;
            $customers->nama_customer = $request->nama_customer;
            $customers->telepon = $request->telepon;
            $customers->cabang_id = '2';
            $customers->save();
        }

        if ($request->customer_filter_id == '3') {

            $antrianNomors = new SitumpurAntrianCsNomor;
            
            $antrianNomorSimpans = new SitumpurAntrianSimpan;
            $antrianNomorSimpans->jabatan = "cs";

        } else {

            $antrianNomors = new SitumpurAntrianDesainNomor;
            
            $antrianNomorSimpans = new SitumpurAntrianSimpan;
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

    public function antrianCustomerForm(Request $request, $id)
    {
        if ($id == '3') {
            $nomors = SitumpurAntrianCsNomor::orderBy('id', 'desc')->first();
            return view('antrian.customerFormCs', ['customer_filter_id' => $id, 'nomors' => $nomors]);
        } else {
            $nomors = SitumpurAntrianDesainNomor::orderBy('id', 'desc')->first();
            return view('antrian.customerFormDesain', ['customer_filter_id' => $id, 'nomors' => $nomors]);
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

        return view('situmpur.cs', ['cs' => $cs]);
    }

    public function csCreate()
    {
        return view('situmpur.cs.create');
    }

    public function csStore(Request $request)
    {
        $cs = new SitumpurCs;
        $cs->nomor = $request->nomor;
        $cs->karyawan_id = $request->karyawan_id;
        $cs->created_by = Auth::user()->id;
        $cs->save();
        
        return redirect()->route('situmpur.cs.index')->with('status', 'Data CS berhasil ditambah');
    }

    public function csEdit($id)
    {
        $cs = SitumpurCs::find($id);
        return view('situmpur.cs.edit', ['cs' => $cs]);
    }

    public function csUpdate(Request $request, $id)
    {
        $cs = SitumpurCs::find($id);
        $cs->nomor = $request->nomor;
        $cs->karyawan_id = $request->karyawan_id;
        $cs->updated_by = Auth::user()->id;
        $cs->save();

        return redirect()->route('situmpur.cs.index')->with('status', 'Data CS berhasil diubah');
    }

    public function csDelete(Request $request, $id)
    {
        $cs = SitumpurCs::find($id);
        $cs->deleted_by = Auth::user()->id;
        $cs->save();

        $cs->delete();

        return redirect()->route('situmpur.cs.index')->with('status', 'Data CS berhasil dihapus');
    }

    public function antrianCs()
    {
        return view('situmpur.antrianCs');
    }

    public function antrianCsNomor()
    {
        $nomors = SitumpurAntrianCsNomor::where('status', '!=', '3')->get();

        return response()->json([
            'success' => 'Success',
            'data' => $nomors
        ]);
    }

    public function antrianCsOn()
    {

    }

    public function antrianCsOff()
    {
        
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
        return view('situmpur.desain.create');
    }

    public function desainStore(Request $request)
    {
        $desains = new SitumpurDesain;
        $desains->nomor = $request->nomor;
        $desains->karyawan_id = $request->karyawan_id;
        $desains->created_by = Auth::user()->id;
        $desains->save();

        return redirect()->route('situmpur.desain.index')->with('status', 'Data desain berhasil ditambah');
    }

    public function desainEdit($id)
    {
        $desain = SitumpurDesain::find($id);

        return redirect()->route('situmpur.desain.edit', ['desain' => $desain]);
    }

    public function desainUpdate(Request $request, $id)
    {
        $desain = SitumpurDesain::find($id);
        $desain->nomor = $request->nomor;
        $desain->karyawan_id = $request->karyawan_id;
        $desain->updated_by = Auth::user()->id;
        $desain->save();

        return redirect()->route('situmpur.desain.index')->with('status', 'Data berhasil diubah');
    }

    public function desainDelete(Request $request, $id)
    {
        $desain = SitumpurDesain::find($id);
        $desain->deleted_by = Auth::user()->id;
        $desain->save();

        $desain->delete();
    }

    public function antrianDesain()
    {
        $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
        return view('situmpur.antrianDesain', ['status_desainer' => $status_desainer]);
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
        $idk = Auth::user()->karyawan_id;
        $karyawan = MasterKaryawan::where('id', $idk)->with('desainer')->first();
        $desain_nomor = $karyawan->desainer->title;
        $status = "on";
        
        event(new SitumpurDesainStatus($desain_nomor, $status));

        $desainer = SitumpurDesain::find($id);
        $desainer->status = "on";
        $desainer->save();

        $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
        return redirect()->route('situmpur.antrianDesain', ['status_desainer' => $status_desainer]);
    }

    public function antrianDesainOff(Request $request, $id)
    {
        $idk = Auth::user()->karyawan_id;
        $karyawan = MasterKaryawan::where('id', $idk)->with('desainer')->first();
        $desain_nomor = $karyawan->desainer->title;
        $status = "off";
        
        event(new SitumpurDesainStatus($desain_nomor, $status));

        $desainer = Desainer::find($id);
        $desainer->status = "off";
        $desainer->save();

        $status_desainer = MasterKaryawan::where('id', Auth::user()->karyawan_id)->with('desainer')->first();
        return redirect()->route('situmpur.antrianDesain', ['status_desainer' => $status_desainer]);
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
