<?php

namespace App\Http\Controllers;

use App\Models\Desainer;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DesainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desainers = Desainer::with('karyawan')
            ->get();

        return view('desainer.index', ['desainers' => $desainers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('desainer.create');
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
            "title" => "required|max:50"
        ])->validate();

        $desainers = new Desainer;
        $desainers->title = $request->title;
        $desainers->save();

        return redirect()->route('desainer.create')->with('status', 'Data desainer berhasil ditambah');
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
        $desainer = Desainer::find($id);
        $karyawans = Karyawan::where('jabatan_id', '5')->get();
        
        return view('desainer.edit', ['desainer' => $desainer, 'karyawans' => $karyawans]);
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
        $desainer = Desainer::find($id);
        $desainer->title = $request->title;
        $desainer->karyawan_id = $request->karyawan_id;
        $desainer->save();

        return redirect()->route('desainer.edit', [$desainer->id])->with('status', 'Data desainer berhasil diperbaharui');
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
        $desainer = Desainer::find($id);

        $desainer->deleted_by = Auth::user()->id;
        $desainer->save();

        $desainer->delete();

        return redirect()->route('desainer.index')->with('status', 'Data desainer berhasil dihapus');
    }
}
