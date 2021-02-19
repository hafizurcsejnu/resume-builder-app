<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SignupEmail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function signupEmail($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }

    public static function resetPasswordEmail($email, $reset_pass_code){
        $data = [
            'reset_pass_code' => $reset_pass_code
        ];
        Mail::to($email)->send(new ResetPasswordEmail($data));
    }
}
