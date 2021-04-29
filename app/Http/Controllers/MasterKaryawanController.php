<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MasterMenu;
use App\Models\KaryawanMenu;
use App\Models\MasterCabang;
use Illuminate\Http\Request;
use App\Models\MasterJabatan;
use App\Models\MasterKaryawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MasterKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = MasterKaryawan::with('masterJabatan')->get();

        return view('master.karyawan.index', ['karyawans' => $karyawans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabangs = MasterCabang::get();
        $jabatans = MasterJabatan::get();

        return view('master.karyawan.create', ['cabangs' => $cabangs, 'jabatans' => $jabatans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $karyawans = new MasterKaryawan;
        $karyawans->nama_lengkap = $request->nama_lengkap;
        $karyawans->nama_panggilan = $request->nama_panggilan;
        $karyawans->email = $request->email;
        $karyawans->telepon = $request->telepon;
        $karyawans->master_cabang_id = $request->master_cabang_id;
        $karyawans->master_jabatan_id = $request->master_jabatan_id;
        $karyawans->created_by = Auth::user()->id;
        
        if($request->file('foto')) {
            $file = $request->file('foto')->store('foto', 'public');
            $karyawans->foto = $file;
        }

        $karyawans->save();

        $user = new User;
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = \Hash::make('abataprinting');
        $user->master_karyawan_id = $karyawans->id;
        $user->roles = "guest";

        if($request->file('foto')) {
            $file = $request->file('foto')->store('foto', 'public');
            $user->foto = $file;
        }

        $user->save();
        
        return redirect()->route('karyawan.create')->with('status', 'Data karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = MasterKaryawan::find($id);
        $cabangs = MasterCabang::get();
        $jabatans = MasterJabatan::get();
        
        return view('master.karyawan.edit', ['karyawan' => $karyawan, 'cabangs' => $cabangs, 'jabatans' => $jabatans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $karyawan = MasterKaryawan::find($id);
        $karyawan->nama_lengkap = $request->nama_lengkap;
        $karyawan->nama_panggilan = $request->nama_panggilan;
        $karyawan->email = $request->email;
        $karyawan->telepon = $request->telepon;
        $karyawan->master_cabang_id = $request->master_cabang_id;
        $karyawan->master_jabatan_id = $request->master_jabatan_id;
        $karyawan->updated_by = Auth::user()->id;

        if($request->file('foto')) {
            if($karyawan->foto && file_exists(storage_path('app/public/' . $karyawan->foto))) {
                \Storage::delete('public/' . $karyawan->foto);
            }
            $file = $request->file('foto')->store('avatar', 'public');
            $karyawan->foto = $file;
        }

        $karyawan->save();

        $user = User::where('master_karyawan_id', $id)->first();
        $user->name = $request->nama_panggilan;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('karyawan.index')->with('status', 'Data karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request, $id)
    {
        $karyawan = MasterKaryawan::find($id);
        $karyawan->deleted_by = Auth::user()->id;
        $karyawan->save();

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('status', 'Data karyawan berhasil dihapus');
    }

    public function akses(Request $request, $id)
    {
        $karyawan = MasterKaryawan::find($id);
        $karyawanMenu = KaryawanMenu::where('master_karyawan_id', $id)
            ->with('masterKaryawan')
            ->get();
        $main_menus = MasterMenu::where('level_menu', 'main_menu')->get();
        $sub_menus = MasterMenu::where('level_menu', 'sub_menu')->get();

        return view('master.karyawan.akses', ['karyawan' => $karyawan, 'karyawanMenu' => $karyawanMenu, 'main_menus' => $main_menus, 'sub_menus' => $sub_menus]);
    }

    public function aksesSimpan(Request $request, $id)
    {

        $karyawanMenus = KaryawanMenu::where('master_karyawan_id', $id)->get();
        
        if (count($karyawanMenus) == 0) {
            
            foreach ($request->menu as $key => $menu) {
                $karyawanMenuCreate = new KaryawanMenu;
                $karyawanMenuCreate->master_karyawan_id = $id;
                $karyawanMenuCreate->master_menu_id = $menu;
                $karyawanMenuCreate->save();
            }
        } else {
            $karyawanMenuHapus = KaryawanMenu::where('master_karyawan_id', $request->id);
            $karyawanMenuHapus->delete();

            foreach ($request->menu as $key => $menu) {
                $karyawanMenuCreate = new KaryawanMenu;
                $karyawanMenuCreate->master_karyawan_id = $id;
                $karyawanMenuCreate->master_menu_id = $menu;
                $karyawanMenuCreate->save();
            }
        }

        return redirect()->route('karyawan.akses', [$id]);
    }
}
