<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use Illuminate\Http\Request;
use App\Models\OutletModel;
use App\Models\OutletTindakanListModel;
use App\Models\PasienModel;

class PendaftaranPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['outlet'] = OutletModel::all();
        $data['outlet'] = OutletModel::all();
        $member = PasienModel::where('token', session('token'))->first();
        $nik = $member->nik;
        $cahartMember = CartModel::where('nik', $nik)->first();
        if ($cahartMember == null) {
            $data['token'] = "";
        } else {
            $data['token'] = $cahartMember->token;
        }
        return view('pendaftaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data['id_outlet'] = $request->outletid;
        $data['registTo'] = $request->registToo;
        return view('pendaftaran.nonPersonal', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $getIn_url = explode("t-kn", $token);
        $idOuttlet = $getIn_url[0];
        $tknpasien = $getIn_url[1];
        // var_dump($tknpasien);
        // die;
        $data['keteranganTindakan'] = "Orang lain";
        $data['tknPasien'] = $tknpasien;
        $data['outletId'] = $idOuttlet;
        $data['tindakan'] = OutletTindakanListModel::Join('master_tindakan', 'master_tindakan.id', '=', 'Outlet_tindakan_list.outletTindakan')
            ->join('master_outlet', 'master_outlet.id', '=', 'Outlet_tindakan_list.outletID')
            ->where('Outlet_tindakan_list.outletID', '=', $idOuttlet)
            ->groupByRaw('Outlet_tindakan_list.id')
            ->select('Outlet_tindakan_list.price as harga', 'Outlet_tindakan_list.id as idList_tindakan', 'master_tindakan.*')
            ->get();
        return view('pendaftaran.nonPersonalPemesanan', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // var_dump($id);
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
        //
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