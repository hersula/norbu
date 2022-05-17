<?php

namespace App\Http\Controllers;

use App\Models\OutletModel;
use App\Models\TargetGenModel;
use Illuminate\Http\Request;

class TargetGenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $target['target'] = TargetGenModel::where('status', 'Aktif')
            ->get();

        return view('targetGen.index', $target);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('targetgen.create');
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
            'nameTargetGen' => 'required'
        ]);

        $namaTargetGen= TargetGenModel::where('nameTargetGen', '=', $request->nameTargetGen)->get();
        if ($namaTargetGen->count() > 0) {
            return back()->with('error', 'Nama Target Gen yang dimasukkan sudah terdaftar di sistem!');
        } 

        $targetgen = TargetGenModel::create([
            'nameTargetGen'  => $request->nameTargetGen,
            'status'    => 'Aktif'
        ]);

        if ($targetgen) {

            return redirect('/targetgen')->with('success', 'Data Target Gen baru berhasil ditambahkan ');
        } else {

            return back()->with('error', 'Data Traget Gen tidak berhasil ditambahkan ke dalam sistem');
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
        $targetgen = TargetGenModel::findOrFail($id);
        return view('targetGen.show', compact('targetgen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $targetgen = TargetGenModel::findOrFail($id);
        return view('targetgen.edit', compact('targetgen'));
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
            'nameTargetGen' => 'required'
        ]);

        $targetgen = TargetGenModel::findOrFail($id);
        //$targetgen = TargetGenModel::findOrFail($request->idgent);
        $namaTargetGen= TargetGenModel::where('nameTargetGen', '=', $request->nameTargetGen)->get();
        if ($namaTargetGen->count() > 0) {
            return back()->with('error', 'Nama Target Gen yang dimasukkan sudah terdaftar di sistem!');
        } 
        $targetgen->update([
            'nameTargetGen' => $request->nameTargetGen
        ]);


        if ($targetgen) {
            return redirect('/targetgen')->with('success', 'Data Target Gen berhasil diubah');
        } else {
            return back()->with('error', 'Data Target Gen tidak berhasil diubah');
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

        $targetgen = TargetGenModel::find($request->targetid);
        $targetgen->status = 'Non Aktif';
        $targetgen->save();

        if ($targetgen) {
           return back()->with('success','Data Target Gen berhasil dihapus');
        } else {
            return back()->with('error','Data Target Gen tidak berhasil dihapus');
        }
        /*
        TargetGenModel::where(['id' => $request->targetid])->delete();
        return redirect('/targetgen')->with('success', 'Data Target Gen berhasil dihapus');
        */
    }
}
