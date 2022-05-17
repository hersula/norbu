<?php

namespace App\Http\Controllers;

use App\Models\OutletModel;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet['outlet'] = OutletModel::where('status', 'Aktif')
            ->get()->sortDesc();
        return view('outlet.index', $outlet);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'address'   => 'required',
            'phone'     => 'required',
            'isFaskes'  => 'required'
        ]);

        $namaOutlet = OutletModel::where('name', '=', $request->name)->get();
        if ($namaOutlet->count() > 0) {
            return back()->with('error', 'Maaf! Nama Outlet sudah ada di sistem.');
        } 
        $alamat = OutletModel::where('address', '=', $request->address)->get();
        if ($alamat->count() > 0) {
            return back()->with('error', 'Maaf! Alamat Outlet sudah ada di sistem.');
        } 

        $outlet = OutletModel::create([
            'marketingID'   => 0,
            'name'          => $request->name,
            'address'       => $request->address,
            'phone'         => $request->phone,
            'isFaskes'      => $request->isFaskes,
            'status'        => 'Aktif',
            'createdAt'     => NOW()
        ]);

        if ($outlet) {
            return redirect('/outlet')->with('success', 'Data Outlet baru berhasil ditambahkan ke dalam sistem');
        } else {
            return back()->with('error', 'Data Outlet baru tidak berhasil ditambahkan ke dalam sistem');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = OutletModel::findOrFail($id);
        return view('outlet.show', compact('outlet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet = OutletModel::findOrFail($id);
        return view('outlet.edit', compact('outlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'namaOutlet'    => 'required',
            'address'       => 'required',
            'phone'         => 'required',
            'isFaskes'      => 'required'
        ]);

        $outlet = OutletModel::findOrFail($request->idOutlet);
      
        $namaOutlet= OutletModel::select('*')
                ->where('name', '=', $request->namaOutlet)
                ->where('id', '<>', $request->idOutlet)
                ->get();
        if ($namaOutlet->count() > 0) {
            return back()->with('error', 'Maaf! Nama Outlet sudah ada di sistem.');
        } 
       
        $alamat= OutletModel::select('*')
                ->where('address', '=', $request->address)
                ->where('id', '<>', $request->idOutlet)
                ->get();
        if ($alamat->count() > 0) {
            return back()->with('error', 'Maaf! Alamat Outlet sudah ada di sistem.');
        } 

        $outlet->update([
            'name'      => $request->namaOutlet,
            'address'   => $request->address,
            'phone'     => $request->phone,
            'isFaskes'  => $request->isFaskes
        ]);

        if ($outlet) {
            return redirect('/outlet')->with('success', 'Data Outlet berhasil diubah');
        } else {
            return back()->with('error', 'Data Outlet tidak berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $outlet = OutletModel::find($request->otletID);
        $outlet->status = 'Non Aktif';
        $outlet->update();

        if ($outlet) {
            return back()->with('success', 'Data Outlet berhasil dihapus');
        } else {
            return back()->with('error', 'Data Outlet tidak berhasil dihapus');
        }
    }
}