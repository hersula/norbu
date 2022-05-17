<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CartModel;
use App\Models\PasienModel;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($request->tokenPasien == null) {
            $member = PasienModel::where('token', session('token'))->first();
            $nik = $member->nik;
            CartModel::create([
                'nik' => $nik,
                'nikTo' =>  $nik,
                'outletID' => $request->OutletID,
                'tindakanID' => $request->idTindakan,
                'registerTo' => $request->registTo,
                'gejala' => $request->gejala,
                'deskripsiGejala' =>  $request->keteranganGejala == null ? 'Tindak Ada Gejala ' : $request->keteranganGejala,
                'qty' => 1,
                'price' =>   $request->hargaTindakan,
            ]);
            return redirect('/pemesanan')->with('success', 'Tindakan telah di buat');
        } else {
            $member = PasienModel::where('token', session('token'))->first();
            $nik = $member->nik;
            $memberTo = PasienModel::where('token', $request->tokenPasien)->first();
            $nikTo = $memberTo->nik;
            CartModel::create([
                'nik' => $nik,
                'nikTo' =>  $nikTo,
                'outletID' => $request->OutletID,
                'tindakanID' => $request->idTindakan,
                'registerTo' => $request->registTo,
                'gejala' => $request->gejala,
                'deskripsiGejala' =>  $request->keteranganGejala == null ? 'Tindak Ada Gejala ' : $request->keteranganGejala,
                'qty' => 1,
                'price' =>   $request->hargaTindakan,
            ]);
            return redirect('/pemesanan')->with('success', 'Tindakan telah di buat');
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
        $cart = CartModel::where('id', $id)->delete();
        if ($cart) {
            return response()->json(array('success' => true));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    }
}