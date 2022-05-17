<?php

namespace App\Http\Controllers;

use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'required' => ':attribute harus diisi',
            'email' => ':attribute  tidak valid',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput($request->all)->with('error', 'Login Gagal');
        }
        $encriptPassword = md5($request->password);
        $admin = KaryawanModel::where(['password' => $encriptPassword])
            ->where(['email' => $request->email])
            ->join('master_outlet', 'master_outlet.id', '=', 'master_karyawan.outletID')
            ->join('karyawan_role_list', 'karyawan_role_list.karyawanID', '=', 'master_karyawan.id')
            ->join('master_roles', 'master_roles.id', '=', 'karyawan_role_list.rolesID')
            ->select('master_outlet.id as idOutlet', 'master_outlet.name as namaOutlet', 'master_karyawan.status', 'master_karyawan.id as idKaryawan', 'master_karyawan.name as namaKaryawan', 'master_karyawan.email', 'master_outlet.isFaskes', 'master_roles.roleName')
            ->first();

        if (!empty($admin)) {
            $request->session()->regenerate();
            if ($admin->status == "Aktif") {
                session([
                    "login" => true,
                    "fullName" => $admin->namaKaryawan,
                    "email" => $admin->email,
                    "outlet" => $admin->namaOutlet,
                    "namaRole" => $admin->roleName,
                    "isFaskes" => $admin->isFaskes,
                    "idOutlet" => $admin->idOutlet,
                ]);
                return redirect()->intended('/dashboard');
            } else {

                return redirect('/admin')->with('error', 'Login Gagal');
            }
        } else {
            return redirect('/admin')->with('error', 'Login Gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Session::flush();
        return redirect('/admin');
    }
}