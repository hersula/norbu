<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasienModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Mail;

class ReserPasswordMember extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.forgotPassword');
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
        $member = PasienModel::where(['email' => $request->email])->first();
        // var_dump($member->token);
        // die;

        if ($member != null) {
            $token = $member->token;
            $nama = $member->name;
            MailController::confrmEmail($request->email, $nama, $token);
            return redirect('/')->with('success', 'Silahkan check email anda');
        }
        return redirect('/')->with('error', 'email anda belum terdaftar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $data['token'] = $token;
        return view('login.resetPassword', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($token)
    {
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
        // var_dump($id);
        // die;
        $error = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute harus lebih :min karakter',
            'max' => ':attribute harus  :max karakter',
            'numeric' => ':attribute harus angka',
            'unique' => ':attribute sudah terdaftar',
            'same' => ':attribute tidak cocok',
            'digits' => ':attribute harus  :digits karakter',
            'email' => ':attribute  tidak valid',
        ];
        $rules = [
            'password' => 'required|min:6',
            'confirmpassword' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules, $error);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all)->with('error', 'Gagal');
        }
        $newPassword = Hash::make($request->password);
        PasienModel::where('token', $request->token)
            ->update(['password' => $newPassword]);

        return redirect('/')->with('success', 'Ubah Password success silahkan login');
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