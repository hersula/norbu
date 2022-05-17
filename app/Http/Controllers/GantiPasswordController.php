<?php

namespace App\Http\Controllers;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class GantiPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gantiPassword.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gantiPassword.create');
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
            'name' => 'required'
        ]);
        /*
        $email= Session::get('email');
        $gantiPassword= KaryawanModel::find($request->$email);
        $gantiPassword->password=md5($request->password);
        $gantiPassword->update();
        */
        $email= Session::get('email');
        $passwordBaru=$request->password;
        $gantiPassword= DB::table('master_karyawan')
              ->where('email', $email)
              ->update(['password' => md5($passwordBaru)]);
        if ($gantiPassword) {
            return redirect('/gantiPassword')->with('success', 'Password baru berhasil diubah');
        } else {
            return back()->with('error', 'Password baru tidak berhasil diubah');
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
