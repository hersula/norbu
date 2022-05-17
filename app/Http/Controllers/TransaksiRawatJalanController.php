<?php

namespace App\Http\Controllers;

use App\Models\CountryModel;
use App\Models\OutletModel;
use App\Models\PasienModel;
use App\Models\TipePembayaranModel;
use App\Models\TindakanModel;
use App\Models\OutletTindakanListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TransaksiRawatJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sesOutlet['sesOutlet']= Session::get('outlet');
        $data['country'] = CountryModel::all();
        $data['outlet'] = OutletModel::select(
            "*"
        )
            ->where('status', '=', 'Aktif')
            ->where('isFaskes', '=', '0')
            ->get();  
        $data['tipepembayaran']=TipePembayaranModel::all();
        $data['tindakan']=TindakanModel::select(
            "master_tindakan.id", "master_tindakan.name as jenis_tindakan"
        )
        ->join('outlet_tindakan_list', 'master_tindakan.id', 'outlet_tindakan_list.outletTindakan')
        ->join('master_outlet', 'master_outlet.id', 'outlet_tindakan_list.outletID')
        ->where('master_tindakan.status', '=', 'Aktif')
        ->where('master_outlet.name', '=', $sesOutlet)
        ->get();

        return view('rawatjalan.index', $data,$sesOutlet); 
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
        
        $pasien = PasienModel::create([
            'nik'           => $request->nik,
            'name'          => strtoupper($request->name),
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => strtoupper($request->address),
            'gender'        => $request->gender,
            'placeOfBirth'  => strtoupper($request->placeOfBirth),
            'dateOfBirth'   => $request->dateOfBirth,
            'avatar'        => 'icon_avatar.png',
            'token'         => $tokenVerifikasi,
            'status'        => 'Aktif',
            'passport'      => $request->passport,
            'country'=> $request->country[0] == null ? $request->country[1] : $request->country[0],
            'isWNA'         => $request->kewarganegaraan == 'WNA' ? '1' : '0',
            'isSelfRegister'=> 1,
            'isEmailVerified'=>0,
            'createdAt'     =>NOW(),
            'password'      => Hash::make($request->password)
        ]);

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