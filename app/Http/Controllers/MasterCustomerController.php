<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterCustomer;
use Illuminate\Support\Facades\Auth;

class MasterCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = MasterCustomer::get();

        return view('master.customer.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customers = new MasterCustomer;
        $customers->nama = $request->nama;
        $customers->telepon = $request->telepon;
        $customers->created_by = Auth::user()->id;
        $customers->save();

        return redirect()->route('master.customer.index')->with('status', 'Data customer berhasil ditambah');
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
        $customer = MasterCustomer::find($id);
        
        return view('master.customer.edit', ['customer' => $customer]);
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
        $customer = MasterCustomer::find($id);
        $customer->nama = $request->nama;
        $customer->telepon = $request->telepon;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        return redirect()->route('master.customer.index')->with('status', 'Data customer berhasil diperbaharui');
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
        $customer = MasterCustomer::find($id);
        
        $customer->deleted_by = Auth::user()->id;
        $customer->save();

        $customer->delete();

        return redirect()->route('customer.index')->with('status', 'Data customer berhasil dihapus');
    }
}
