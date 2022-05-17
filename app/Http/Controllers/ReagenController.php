<?php

namespace App\Http\Controllers;

use App\Models\ReagenModel;
use App\Models\TargetGenModel;
use App\Models\TargetGenListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reagen['reagen'] = ReagenModel::where('status', 'Aktif')
            ->get();
        return view('reagen.index', $reagen);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reagen = ReagenModel::where('status', 'Aktif')
            ->get();
        $target = TargetGenModel::where('status', 'Aktif')
            ->get();
        return view('reagen.create', compact('reagen'), compact('target'));
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
            'nameReagen' => 'required',
            'isActive'  => 'required'
        ]);

        $namaReagen= ReagenModel::where('nameReagen', '=', $request->nameReagen)->get();
        if ($namaReagen->count() > 0) {
            return back()->with('error', 'Nama Reagen yang dimasukkan sudah terdaftar di sistem!');
        } 

        $reagen = ReagenModel::create([
            'nameReagen'    => $request->nameReagen,
            'isActive'      => $request->isActive,
            'status'        => 'Aktif'
        ]);

        if ($reagen) {
            return redirect('/reagen')->with('success', 'Data Reagen baru berhasil ditambahkan ke dalam sistem');
        } else {
            return back()->with('error', 'Data Reagen baru tidak berhasil ditambahkan ke dalam sistem');
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

        $data['reagen']=ReagenModel::findOrFail($id);
        
        $data['targetgen']=TargetGenListModel::where('reagenID',$id)
             ->join('master_target_gen', 'master_target_gen.id', 'target_gen_list.targetGenID')->get();
        $data['masterTargetGen'] = DB::table('master_target_gen')
        ->select('id', 'nameTargetGen')
        ->whereNotIn('id',DB::table('target_gen_list')->select('targetGenID')->where('reagenID','=',$id)->pluck('targetGenID')
        ->toArray())
        ->get();
         return view('reagen.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        
        $data['reagen']=ReagenModel::findOrFail($id);
        
        $data['targetgen']=TargetGenListModel::where('reagenID',$id)
             ->join('master_target_gen', 'master_target_gen.id', 'target_gen_list.targetGenID')->get();
        $data['masterTargetGen'] = DB::table('master_target_gen')
        ->select('id', 'nameTargetGen')
        ->whereNotIn('id',DB::table('target_gen_list')->select('targetGenID')->where('reagenID','=',$id)->pluck('targetGenID')
        ->toArray())
        ->get();
         return view('reagen.edit', $data);
      
      
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
            'nameReagen' => 'required',
            'isActive'  => 'required'
        ]);

        $reagen = ReagenModel::findOrFail($id);
        $namaReagen= ReagenModel::where('nameReagen', '=', $request->nameReagen)->get();
        if ($namaReagen->count() > 0) {
            return back()->with('error', 'Nama Reagen yang dimasukkan sudah terdaftar di sistem!');
        } 

        $reagen->update([
            'nameReagen' => $request->nameReagen,
            'isActive'   => $request->isActive
        ]);

        if ($reagen) {
            return redirect('/reagen')->with('success', 'Data Reagen berhasil diubah');
        } else {
            return back()->with('error', 'Data Reagen tidak berhasil diubah');
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
        $reagen = ReagenModel::find($request->reagenid);
        $reagen->status = 'Non Aktif';
        $reagen->save();

        if ($reagen) {
           return back()->with('success','Data Reagen berhasil dihapus');
        } else {
            return back()->with('error','Data Reagen tidak berhasil dihapus');
        }
    }
}