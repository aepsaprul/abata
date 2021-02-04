<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::get();
        $jabatans = Jabatan::get();

        return view('jabatan.index', ['jabatans' => $jabatans, 'menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
                "nama" => "required|max:50"
        ])->validate();

        $jabatans = new Jabatan;
        $jabatans->nama = $request->nama;
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
        $jabatan = Jabatan::find($id);

        return view('jabatan.edit', ['jabatan' => $jabatan]);
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
        $jabatan = Jabatan::find($id);
        $jabatan->nama = $request->nama;
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
        $jabatan = Jabatan::find($id);

        $jabatan->deleted_by = Auth::user()->id;
        $jabatan->save();
        
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('status', 'Jabatan berhasil dihapus');
    }

    public function akses(Request $request, $id)
    {
        $jabatan = Jabatan::find($id);
        $menus = Menu::get();

        return view('jabatan.akses', ['jabatan' => $jabatan, 'menus' => $menus]);
    }

    public function aksesSimpan(Request $request, $id)
    {
        $save_menu_akses = Jabatan::find($id);
        $save_menu_akses->menu_akses = json_encode($request->menu);
        $save_menu_akses->save();

        return redirect()->route('jabatan.akses', [$save_menu_akses->id]);
    }
}
