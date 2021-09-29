<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function loginForm()
    {
        return view('auth.login_user');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                $secretKey = config('services.recaptcha.secret');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                if (!$response->success) {
                    Session::flash('g-recaptcha-response-error', 'گزینه من ربات نیستم را انتخاب کنید.');
                    //$fail($attribute . 'google reCaptcha failed');
                }
            },
        ],$messages = [
            'email.required'=>'ایمیل خود را وارد کنید.',
            'email.email'=>'ایمیل وارد شده معتبر نمی باشد.',
            'password.required'=>'رمز عبور را وارد کنید.',
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){

            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'نام کاربری یا رمز عبور اشتباه است.');

    }
    public function profile()
    {
        return view('auth.profile');
    }

    public function logOut(Request $request)
    {

    }
}
