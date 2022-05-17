<?php

namespace App\Http\Controllers;

use App\Mail\Forgot;
use App\Mail\ForgotPassword;
use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function SendSignEmail($name, $email, $verifikasi_code)
    {
        $data = [
            'name' => $name,
            'verifikasi_code' => $verifikasi_code
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }
    public static function confrmEmail($email, $name, $token)
    {
        $data = [
            'token' => $token,
            'name' => $name
        ];

        Mail::to($email)->send(new ForgotPassword($data));
    }
}