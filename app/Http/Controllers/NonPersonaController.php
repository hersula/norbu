<?php

namespace App\Http\Controllers;

use App\Models\OutletModel;
use Illuminate\Support\Facades\Validator;
use App\Models\PasienModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NonPersonaController extends Controller
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

        return view('pendaftaran.nonPersonal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $error = [
            'required' => ':attribute harus diisi',
            'email' => ':attribute harus berupa email yang valid',
            'min' => ':attribute harus lebih :min karakter',
            'max' => ':attribute harus  :max karakter',
            'numeric' => ':attribute harus angka',
            'same' => ':attribute tidak cocok',
            'digits' => ':attribute harus  :digits karakter',
            'email' => ':attribute  tidak valid',
        ];
        $rules = [
            'nik' => 'required|numeric|digits:16',
            'name' => 'required',
            'address' => 'required',
            'gander' => 'required',
            'phone' => 'required',
            'kewarganegaraan' => 'required',
            'placeOfbirth' => 'required',
            'dateOfbirth' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules, $error);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all)->with('error', 'Regitrasi Gagal Periksa Kembali Data Anda');
        }
        $token = sha1($this->makeCodeToken($request->nik));

        PasienModel::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' =>  $request->email,
            'address' =>  $request->address,
            'gender' =>  $request->gander,
            'phone' =>  $request->phone,
            'country' =>  $request->country[0] == null ? $request->country[1] : $request->country[0],
            'avatar' =>  'icon_avatar.png',
            'isWNA' =>  $request->kewarganegaraan == 'WNA' ? '1' : '0',
            'placeOfBirth' =>  $request->placeOfbirth,
            'token' =>  $token,
            'dateOfBirth' =>  $request->dateOfbirth,
            'isSelfRegister' =>  1,
            'isEmailVerified' =>  0,
            'createdAt' => now(),

        ]);
        return redirect('/nonPersonal/' . $token)->with('success', 'Pendaftaran berhasil silahkan pilih Outlet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function makeCodeToken($nik)
    {
        $al = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r',
        ];
        $len = $nik ? random_int(7, 12) : $nik;
        for ($i = 0; $i < count($al); $i++) {
            $tkn = $len . $al[$i];
            return $tkn;
        }
    }
    public function show($token)
    {

        $data['outlet'] = OutletModel::all();
        $data['tknpasien'] = $token;
        return view('pendaftaran.nonPersonalOutlet', $data);
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