<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$cabangs = Cabang::get();

			return view('cabang.index', ['cabangs' => $cabangs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
			return view('cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			$cabangs = new Cabang;
			$cabangs->nama = $request->nama;
			$cabangs->save();

			return redirect()->route('cabang.create')->with('status', 'Data cabang berhasil ditambah');
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
			$cabang = Cabang::find($id);

			return view('cabang.edit', ['cabang' => $cabang]);
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
			$cabang = Cabang::find($id);
			$cabang->nama = $request->nama;
			$cabang->save();

			return redirect()->route('cabang.index')->with('status', 'Data cabang berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function delete(Request $request, $id)
    {
			$cabang = Cabang::find($id);
			$cabang->delete();

			return redirect()->route('cabang.index')->with('status', 'Data cabang berhasil dihapus');
    }
}
