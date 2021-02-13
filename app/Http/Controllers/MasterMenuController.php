<?php

namespace App\Http\Controllers;

use App\Models\MasterMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = MasterMenu::get();

        return view('master.menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menus = new MasterMenu;
        $menus->nama_menu = $request->nama_menu;
        $menus->link = $request->link;
        $menus->created_by = Auth::user()->id;
        $menus->save();

        return redirect()->route('menu.create')->with('status', 'Menu berhasil ditambahkan ');
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
        $menu = MasterMenu::findOrFail($id);
        
        return view('master.menu.edit', ['menu' => $menu]);
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
        $menu = MasterMenu::find($id);
        $menu->nama_menu = $request->nama_menu;
        $menu->link = $request->link;
        $menu->updated_by = Auth::user()->id;
        $menu->save();

        return redirect()->route('menu.edit', [$menu->id])->with('status', 'Menu berhasil diubah');
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
        $menu = MasterMenu::find($id);
        
        $menu->deleted_by = Auth::user()->id;
        $menu->save();

        $menu->delete();

        return redirect()->route('menu.index')->with('status', 'Menu berhasil dihapus');
    }
}
