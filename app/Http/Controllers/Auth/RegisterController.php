<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function registerForm()
    {
        return view('auth.register_user');
    }

    public function register(Request $request)
    {
        //return $request;

        $request->validate([
            'name'=>'required|max:30|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|max:20:mix:8',
        ],$messages = [
            'name.unique' => 'این نام کاربری تکراری است',
            'ame.required' => 'نام کاربری را وارد کنید ',
            'email.required' => 'آدرس ایمیل را وارد کنید',
            'email.unique' => 'این ایمیل تکراری است',
            'password.required' => 'رمز عبور را وارد کنید',
            'password.max' => 'حداکثر تعداد کاراکتر رمز عبور۲۰ کاراکتر',
            'password.min' => 'حداقل تعداد کاراکتر رمز عبور۸  کاراکتر',
            'password.confirmed' => 'رمز عبور و تکرار آن یکی نیستند'
        ]);

        $user = User::create([
            'user_name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_code' => Str::random(40),
        ]);


    }


}
