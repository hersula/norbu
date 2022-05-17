<?php

namespace App\Http\Controllers;

use App\Models\OutletModel;
use App\Models\OutletTindakanListModel;
use App\Models\TindakanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\Output;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tindakan['tindakan'] = TindakanModel::where('status', 'Aktif')
            ->get()->sortDesc();
        return view('tindakan.index', $tindakan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = OutletModel::where('status', 'Aktif')
            ->get();
        $gerai = OutletModel::where('status', 'Aktif')
            ->get();
        return view('tindakan.create', compact('outlet'), compact('gerai'));
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
            'name'              => 'required',
            'description'       => 'required',
            'price'             => 'required',
            'typeTindakan'      => 'required',
            'spesimen'          => 'required',
            'outlet'            => 'required',
            'price'             => 'required'
        ]);

        TindakanModel::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => 0,
            'typeTindakan'  => $request->typeTindakan,
            'spesimen'      => $request->spesimen,
            'status'        => 'Aktif',
            'createdAt'     => NOW()
        ]);

        $tindakanID = TindakanModel::where('status', 'Aktif')->max('id');
        $outlet = $request->outlet;
        $price = $request->price;
        $jumlah = count($request->outlet);
        for ($i = 0; $i < $jumlah - 1; $i++) {
            OutletTindakanListModel::create([
                'outletID'          => $outlet[$i],
                'outletTindakan'    => $tindakanID,
                'price'             => $price[$i],
                'isVisibleToPasien' => $request->isVisibleToPasien,
                'status'            => 'Aktif'
            ]);
        }

        return redirect('/tindakan')->with('success', 'Data Tindakan baru berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['outlet'] = OutletTindakanListModel::where('outletTindakan', $id)
        ->join('master_tindakan', 'master_tindakan.id', 'outlet_tindakan_list.outletTindakan')
        ->join('master_outlet', 'master_outlet.id', 'outlet_tindakan_list.outletID')
        ->select('master_tindakan.id as idTindakan', 'master_tindakan.typeTindakan', 'master_tindakan.name as namaTindakan', 'master_tindakan.spesimen', 'master_tindakan.description', 'master_outlet.id as idOutlet', 'master_outlet.name as namaOutlet', 'outlet_tindakan_list.price')->first();
        $data['tindakan'] = OutletTindakanListModel::where('outletTindakan', $id)
            ->join('master_tindakan', 'master_tindakan.id', 'outlet_tindakan_list.outletTindakan')
            ->join('master_outlet', 'master_outlet.id', 'outlet_tindakan_list.outletID')
            ->select('master_tindakan.id as idTindakan', 'master_tindakan.typeTindakan', 'master_outlet.id as idOutlet', 'master_outlet.name as namaOutlet', 'outlet_tindakan_list.price')->get();
        $data['masterOutlet'] = OutletModel::all();
        return view('tindakan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['outlet'] = OutletTindakanListModel::where('outletTindakan', $id)
        ->join('master_tindakan', 'master_tindakan.id', 'outlet_tindakan_list.outletTindakan')
        ->join('master_outlet', 'master_outlet.id', 'outlet_tindakan_list.outletID')
        ->select('master_tindakan.id as idTindakan', 'master_tindakan.typeTindakan', 'master_tindakan.name as namaTindakan', 'master_tindakan.spesimen', 'master_tindakan.description', 'master_outlet.id as idOutlet', 'master_outlet.name as namaOutlet', 'outlet_tindakan_list.price')->first();
        $data['tindakan'] = OutletTindakanListModel::where('outletTindakan', $id)
        ->join('master_tindakan', 'master_tindakan.id', 'outlet_tindakan_list.outletTindakan')
        ->join('master_outlet', 'master_outlet.id', 'outlet_tindakan_list.outletID')
        ->select('master_tindakan.id as idTindakan', 'master_tindakan.typeTindakan', 'master_outlet.id as idOutlet', 'master_outlet.name as namaOutlet', 'outlet_tindakan_list.price')->get();
        $data['masterOutlet'] = OutletModel::all();
        return view('tindakan.edit', $data);

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
            'name'              => 'required',
            'description'       => 'required',
            'price'             => 'required',
            'typeTindakan'      => 'required',
            'spesimen'          => 'required',
            'outlet'            => 'required',
            'price'             => 'required'
        ]);

        $tindakan = TindakanModel::findOrFail($id);
        $tindakan->name=$request->name;
        $tindakan->description= $request->description;
        $tindakan->spesimen=$request->spesimen;
        $tindakan->typeTindakan=$request->typeTindakan;
        $tindakan->createdAt=NOW();
        $tindakan->update();
       
        $detailTindakan=DB::table('outlet_tindakan_list')->where('outletTindakan', $id)->delete();
        $outlet= $request->outlet;
        $price=$request->price;
        $jumlah = count($request->outlet);

        for ($i=0; $i < $jumlah-1; $i++) { 
                DB::table('outlet_tindakan_list')
                ->insert(
                    ['outletID' => $outlet[$i], 'outletTindakan' => $id, 'price' => $price[$i], 'isVisibleToPasien' => '1', 'status' => 'Aktif']
                );   
        }
        return redirect('/tindakan')->with('success', 'Data Tindakan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tindakan = TindakanModel::find($request->tindakanid);
        $tindakan->status = 'Non Aktif';
        $tindakan->save();
        $tindakanOutlet= DB::table('outlet_tindakan_list')->where('outletTindakan', $request->tindakanid)->update(['status' => 'Non Aktif']);
        return back()->with('success', 'Data Tindakan berhasil dihapus');
    }
}