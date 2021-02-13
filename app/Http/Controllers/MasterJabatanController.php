<?php

namespace App\Http\Controllers;

use App\Models\MasterMenu;
use Illuminate\Http\Request;
use App\Models\MasterJabatan;
use Illuminate\Support\Facades\Auth;

class MasterJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatans = MasterJabatan::get();

        return view('master.jabatan.index', ['jabatans' => $jabatans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jabatans = new MasterJabatan;
        $jabatans->nama_jabatan = $request->nama_jabatan;
        $jabatans->created_by = Auth::user()->id;
        $jabatans->save();

        return redirect()->route('jabatan.create')->with('status', 'Jabatan berhasil disimpan');
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
        $jabatan = MasterJabatan::find($id);

        return view('master.jabatan.edit', ['jabatan' => $jabatan]);
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
        $jabatan = MasterJabatan::find($id);
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->updated_by = Auth::user()->id;
        $jabatan->save();

        return redirect()->route('jabatan.edit', [$jabatan->id])->with('status', 'Jabatan berhasil diubah');
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
        $jabatan = MasterJabatan::find($id);

        $jabatan->deleted_by = Auth::user()->id;
        $jabatan->save();
        
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('status', 'Jabatan berhasil dihapus');
    }

    public function akses(Request $request, $id)
    {
        $jabatan = MasterJabatan::find($id);
        $menus = MasterMenu::get();

        return view('master.jabatan.akses', ['jabatan' => $jabatan, 'menus' => $menus]);
    }

    public function aksesSimpan(Request $request, $id)
    {
        $save_menu_akses = MasterJabatan::find($id);
        $save_menu_akses->menu_akses = json_encode($request->menu);
        $save_menu_akses->save();

        return redirect()->route('jabatan.akses', [$save_menu_akses->id]);
    }
}
