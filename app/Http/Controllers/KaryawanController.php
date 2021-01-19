<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$karyawans = Karyawan::get();

			return view('karyawan.index', ['karyawans' => $karyawans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');
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
					"nama_lengkap" => "required",
					"telepon" => "required"
			])->validate();
			
			$karyawans = new Karyawan;
			$karyawans->nama_lengkap = $request->nama_lengkap;
			$karyawans->alamat = $request->alamat;
			$karyawans->email = $request->email;
			$karyawans->telepon = $request->telepon;
			$karyawans->jabatan_id = $request->jabatan_id;
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
			$karyawan = Karyawan::findOrFail($id);
			
			return view('karyawan.edit', ['karyawan' => $karyawan]);
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
			$karyawan = Karyawan::findOrFail($id);
			$karyawan->nama_lengkap = $request->nama_lengkap;
			$karyawan->alamat = $request->alamat;
			$karyawan->email = $request->email;
			$karyawan->telepon = $request->telepon;
			$karyawan->jabatan_id = $request->jabatan_id;
			$karyawan->updated_by = Auth::user()->id;

			if($request->file('foto')) {
					if($karyawan->foto && file_exists(storage_path('app/public/' . $karyawan->foto))) {
							\Storage::delete('public/' . $karyawan->foto);
					}
					$file = $request->file('foto')->store('avatar', 'public');
					$karyawan->foto = $file;
			}

			$karyawan->save();

			return redirect()->route('karyawan.edit', [$id])->with('status', 'Data karyawan berhasil diubah');
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
			$karyawan = Karyawan::find($id);
			$karyawan->deleted_by = Auth::user()->id;
			$karyawan->save();

			$karyawan->delete();

			return redirect()->route('karyawan.index')->with('status', 'Data karyawan berhasil dihapus');
    }
}
