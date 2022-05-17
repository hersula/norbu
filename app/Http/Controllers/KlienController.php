<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\KlienModel;
use App\Models\TipeKlienModel;

class KlienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kliens['kliens']=KlienModel::where('status', 'Aktif')
        ->get();
        return view('klien.index',$kliens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipeklien=TipeKlienModel::where('status', 'Aktif')
        ->get();
        return view('klien.create', compact('tipeklien'));
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
            'typeClientID'  => 'required',
            'nameClient'    => 'required',
            'address'       => 'required',
            'phone'         => 'required'
        ]);

        $namaClient = KlienModel::where('nameClient', '=', $request->nameClient)->get();
        if ($namaClient->count() > 0) {
            return back()->with('error', 'Nama Klien yang dimasukkan sudah terdaftar di sistem!');
        } 

        $alamatClient = KlienModel::where('address', '=', $request->address)->get();
        if ($namaClient->count() > 0) {
            return back()->with('error', 'Alamat Klien yang dimasukkan sudah terdaftar di sistem!');
        } 

        $phone = KlienModel::where('phone', '=', $request->phone)->get();
        if ($phone->count() > 0) {
            return back()->with('error', 'Nomor Telepon yang dimasukkan sudah terdaftar di sistem!');
        } 

        $klien = KlienModel::create([
            'typeClientID' => $request->typeClientID,
            'nameClient'   => $request->nameClient,
            'address'      => $request->address,
            'phone'        => $request->phone,
            'status'       => 'Aktif'
        ]);

        
        if ($klien) {
            return redirect('/klien')->with('success', 'Data Klien baru berhasil ditambahkan ke dalam sistem');
        } else {

            return back()->with('error', 'Data Klien baru tidak berhasil ditambahkan ke dalam sistem');
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
        $klien = KlienModel::findOrFail($id);
        $tipeklien=TipeKlienModel::where('status', 'Aktif')
        ->get();
        return view('klien.show', compact('klien'), compact('tipeklien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $klien = KlienModel::findOrFail($id);
        $tipeklien=TipeKlienModel::where('status', 'Aktif')
        ->get();
        return view('klien.edit', compact('klien'),compact('tipeklien'));
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
        $this->validate($request, [
            'typeClientID'  => 'required',
            'nameClient'    => 'required',
            'address'       => 'required',
            'phone'         => 'required',
        ]);

        $klien= KlienModel::findOrFail($id);
        
        $namaClient = KlienModel::where('nameClient', '=', $request->nameClient)->get();
        if ($namaClient->count() > 0) {
            return back()->with('error', 'Nama Klien yang dimasukkan sudah terdaftar di sistem!');
        } 

        $alamatClient = KlienModel::where('address', '=', $request->address)->get();
        if ($namaClient->count() > 0) {
            return back()->with('error', 'Alamat Klien yang dimasukkan sudah terdaftar di sistem!');
        } 

        $phone = KlienModel::where('phone', '=', $request->phone)->get();
        if ($phone->count() > 0) {
            return back()->with('error', 'Nomor Telepon yang dimasukkan sudah terdaftar di sistem!');
        } 

        $klien->update([
            'typeClientID'    => $request->typeClientID,
            'nameClient'      => $request->nameClient,
            'address'         => $request->address,
            'phone'           => $request->phone
        ]);

        if ($klien) {
            return redirect('/klien')->with('success', 'Data Klien berhasil diubah');
        } else {

            return back()->with('error', 'Data Klien baru tidak berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $klien = KlienModel::find($request->klienid);
        $klien->status = 'Non Aktif';
        $klien->save();

        if ($klien) {
            
           return back()->with('success','Data Klien berhasil dihapus');
        } else {
            return back()->with('error','Data Klien tidak berhasil dihapus');
        }
    }
}
