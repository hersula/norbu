<?php

namespace App\Http\Controllers;
use App\Models\PasienModel;
use App\Models\CountryModel;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $pasiens['pasiens'] = PasienModel::where('status', 'Aktif')
            ->get();
        */
        $pasiens['pasiens']=PasienModel::paginate(10);

        return view('pasien.index', $pasiens);
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

        $nik=$request->nik;
        $name=$request->name;
        if ($nik != '' && $name == '') {
            $data['pasiens'] = PasienModel::where('master_pasien.nik', 'LIKE', '%'.$nik.'%')
            ->where('master_pasien.status','=', 'Aktif')
            ->select('master_pasien.nik', 'master_pasien.name', 'master_pasien.address', 'master_pasien.dateOfBirth')
            ->get();
            return view('pasien.index', $data);
        }elseif ($nik == '' && $name != '') {
            $data['pasiens'] = PasienModel::where('master_pasien.name', 'LIKE', '%'.$name.'%')
            ->where('master_pasien.status','=', 'Aktif')
            ->select('master_pasien.nik', 'master_pasien.name', 'master_pasien.address', 'master_pasien.dateOfBirth')
            ->get();
            return view('pasien.index', $data);
        }elseif ($nik != '' && $name != '') {
            $data['pasiens'] = PasienModel::where('master_pasien.nik', 'LIKE', '%'.$nik.'%')
            ->where('master_pasien.name', 'LIKE', '%'.$name.'%')
            ->where('master_pasien.status','=', 'Aktif')
            ->select('master_pasien.nik', 'master_pasien.name', 'master_pasien.address', 'master_pasien.dateOfBirth')
            ->get(); 
            return view('pasien.index', $data); 
        }else {
            $data['pasiens']=PasienModel::paginate(10)
            ->orderBy('id', 'desc');
            return view('pasien.index', $data);     
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
        $pasiens = PasienModel::findOrFail($id);
        $country = CountryModel::all();
        return view('pasien.show', compact('pasiens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasiens = PasienModel::findOrFail($id);
        $country = CountryModel::all();
        return view('pasien.edit', compact('pasiens'));
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

        if ($request->hasFile('avatar')) {
            $images = $request->file('avatar');
            $namaFile = $images->getClientOriginalName();
            $tujuanApload = 'avatarPasien';
            $images->move($tujuanApload, $namaFile);
            $pasien = PasienModel::find($id);
            $pasien->avatar = $namaFile;
            $pasien->update();
        }

        $pasien = PasienModel::find($id);
        $phonePasien= PasienModel::select('*')
        ->where('phone', '=', $request->phone)
        ->where('status', '=', 'Aktif')
        ->where('id', '<>', $id)
        ->get();
        if ($phonePasien->count() > 0) {
            return back()->with('error', 'Maaf! Nomor handphone pasien yang dimasukkan sudah terdaftar di sistem.');
        } 
        $emailPasien= PasienModel::select('*')
        ->where('email', '=', $request->email)
        ->where('email', '!=', 'null')
        ->where('email', '!=', '')
        ->where('email', '!=', 'NULL')
        ->where('status', '=', 'Aktif')
        ->where('id', '<>', $id)
        ->get();
        if ($emailPasien->count() > 0) {
            return back()->with('error', 'Maaf! Email pasien yang dimasukkan sudah terdaftar di sistem.');
        } 
        $pasien->nik = $request->nik;
        $pasien->name = strtoupper($request->name);
        $pasien->email = $request->email;
        $pasien->phone = $request->phone;
        $pasien->address = strtoupper($request->address);
        $pasien->gender = $request->gender;
        $pasien->placeOfBirth = strtoupper($request->placeOfBirth);
        $pasien->dateOfBirth = $request->dateOfBirth;
        $pasien->isWNA = $request->isWNA;
        $pasien->passport = $request->passport;
        $pasien->country = $request->country;
        $pasien->update();

        return redirect('/pasien')->with('success', 'Data Pasien berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $pasiens = PasienModel::find($request->pasienid);
        $pasiens->status = 'Non Aktif';
        $pasiens->save();

        if ($pasiens) {
           return back()->with('success','Data Pasien berhasil dihapus');
        } else {
            return back()->with('error','Data Pasien tidak berhasil dihapus');
        }
    }
}