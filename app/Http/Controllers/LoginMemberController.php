<?php

namespace App\Http\Controllers;

use App\Models\CountryModel;
use App\Models\PasienModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class LoginMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('login.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['country'] = CountryModel::all();
        return view('login.registration', $data);
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
            'unique' => ':attribute sudah terdaftar',
            'same' => ':attribute tidak cocok',
            'digits' => ':attribute harus  :digits karakter',
            'email' => ':attribute  tidak valid',
        ];
        $rules = [
            'nik' => 'required|unique:master_pasien|numeric|digits:16',
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|unique:master_pasien|email',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'kewarganegaraan' => 'required',
            'placeOfBirth' => 'required',
            'dateOfBirth' => 'required',
            'password' => 'required|min:6',
            'confirmpassword' => 'required|same:password',
        ];
      
    
       
        $validator = Validator::make($request->all(), $rules, $error);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all)->with('error', 'Regitrasi Gagal Periksa Kembali Data Anda');
        }
        $nik = $request->nik;
        $tokenVerifikasi = sha1($this->makeCodeToken($nik));
        
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

    
        MailController::SendSignEmail($request->name, $request->email, $tokenVerifikasi);
        
        return redirect('/')->with('success', 'Registrasi Sukses. Periksa email Anda untuk verifikasi');
        
    }
    
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
    
    public function verifykasi($code_token)
    {
        $member = PasienModel::where(['token' => $code_token])->first();
        if ($member != null) {
            if ($member->isEmailVerified == 0) {
                $member->isEmailVerified = 1;
                $member->save();
                return redirect('/')->with('success', 'verifikasi berhasil silahkan login');
            } else {
                return redirect('/')->with('error', 'verifikasi gagal');
            }
        }
    }
    public function sigIn(Request $request)
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

        $member = PasienModel::where(['email' => $request->email])->first();

        if (!empty($member)) {
            //cek password
            if (Hash::check($request->password, $member->password)) {

                $request->session()->regenerate();
                if ($member->isEmailVerified == 1) {
                    session([
                        "login" => true,
                        "token" => $member->token,
                        "fullName" => $member->name,

                    ]);
                    return redirect()->intended('/home');
                } else {

                    return redirect('/')->with('error', 'Login Gagal');
                }
            } else {
                return redirect('/')->with('error', 'Login Gagal');
            }
        } else {
            return redirect('/')->with('error', 'Login Gagal');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}