<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutletTindakanListModel;
use App\Models\MasterTindakanModel;


class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $idtindakan = $request->id_outlet;
        $data['keteranganTindakan'] = $request->registTo;
        $data['outletId'] = $request->id_outlet;
        $data['tindakan'] = OutletTindakanListModel::Join('master_tindakan', 'master_tindakan.id', '=', 'Outlet_tindakan_list.outletTindakan')
            ->join('master_outlet', 'master_outlet.id', '=', 'Outlet_tindakan_list.outletID')
            ->groupByRaw('Outlet_tindakan_list.id')
            ->where('Outlet_tindakan_list.outletID', '=', $idtindakan)
            ->select('Outlet_tindakan_list.price as harga', 'Outlet_tindakan_list.id as idList_tindakan', 'master_tindakan.*')
            ->get();
        return view('pendaftaran.personal', $data);
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
        //
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
        var_dump($request->gejala);
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
}