<?php

namespace App\Http\Controllers;


use App\Models\TipeKlienModel;
use Illuminate\Http\Request;

class TipeklienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['tipeklien'] = TipeKlienModel::where('status', 'Aktif')
            ->get();

        return view('tipeKlien.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipeKlien.create');
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
            'nameType' => 'required'
        ]);

        $namaTipeKlien = TipeKlienModel::where('nameType', '=', $request->nameType)->get();
        if ($namaTipeKlien->count() > 0) {
            return back()->with('error', 'Tipe Klien yang dimasukkan sudah terdaftar di sistem!');
        } 

        $tipeklien = TipeKlienModel::create([
            'nameType' => $request->nameType,
            'status'   => 'Aktif'
        ]);

        if ($tipeklien) {
            return redirect('/tipeklien')->with('success', 'Data Tipe Klien berhasil ditambahkan ke dalam sistem');
        } else {
            return back()->with('error', 'Data Tipe Klien tidak berhasil ditambahkan ke dalam sistem');
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
        $tipeklien = TipeKlienModel::findOrFail($id);
        return view('tipeKlien.show', compact('tipeklien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipeklien = TipeKlienModel::findOrFail($id);
        return view('tipeKlien.edit', compact('tipeklien'));
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
            'nameType' => 'required'
        ]);

        $tipeklien = TipeKlienModel::findOrFail($request->idtipe_klien);
        $namaTipeKlien = TipeKlienModel::where('nameType', '=', $request->nameType)->get();
        if ($namaTipeKlien->count() > 0) {
            return back()->with('error', 'Tipe Klien yang dimasukkan sudah terdaftar di sistem!');
        } 

        $tipeklien->update([
            'nameType' => $request->nameType
        ]);

        if ($tipeklien) {

            return redirect('/tipeklien')->with('success', 'Data Tipe Klien  berhasil diubah');
        } else {
            return back()->with('error', 'Data Tipe Klien tidak berhasil diubah');
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
        /*
        TipeKlienModel::where(['id' => $request->klienid])->delete();
        return redirect('/tipeklien')->with('success', 'Data klien berhasil dihapus');
        */
        $tipeklien = TipeKlienModel::find($request->klienid);
        $tipeklien->status = 'Non Aktif';
        $tipeklien->save();

        if ($tipeklien) {
            
           return back()->with('success','Data Tipe Klien berhasil dihapus');
        } else {
            return back()->with('error','Data Tipe Klien tidak berhasil dihapus');
        }
    }
}