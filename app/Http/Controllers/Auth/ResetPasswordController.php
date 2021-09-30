<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    //

    public function resetPassForm(){

        return view('auth.reset_pass_form');
    }

    public function resetPassCheckEmail(Request $request)
    {
        //return $request;
        $request->validate([
            'email'=>'required|email|exists:users'
        ],$messages = [
            'email.required'=>'ایمیل خود را وارد کنید.',
            'email.email'=>'ایمیل وارد شده معتبر نمی باشد.',
            'email.exists'=>'ایمیل وارد شده وجود ندارد.'
        ]);


    }
}
