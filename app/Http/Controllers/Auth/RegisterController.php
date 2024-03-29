<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
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
      // return $request;

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'name'=>'required|max:30|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>['required','confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                 $secretKey = config('services.recaptcha.secret');
                 $response = $value;
                 $userIP = $_SERVER['REMOTE_ADDR'];
                 $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                 $response = \file_get_contents($url);
                 $response = json_decode($response);
                if(!$response->success){
                    Session::flash('g-recaptcha-response-error','گزینه من ربات نیستم را انتخاب کنید.');
                   // $fail($attribute.'google reCaptcha failed');
                }

            },
        ],$messages = [
            'name.unique' => 'این نام کاربری تکراری است.',
            'name.required' => 'نام کاربری را وارد کنید.',
            'first_name.required' => 'نام خود را وارد کنید.',
            'last_name.required'=>'نام خانوادگی خود را وارد کنید.',
            'email.required' => 'آدرس ایمیل را وارد کنید.',
            'email.unique' => 'این ایمیل تکراری است.',
            'password.required' => 'رمز عبور را وارد کنید.',
            'password.mixedCase' => 'رمز عبور باید شامل حداقل یک کاراکتر بزرگ و یک کاراکتر کوچک باشد.',
            'password.min' => 'حداقل تعداد کاراکتر رمز عبور ۸ کاراکتر.',
            'password.confirmed' => 'رمز عبور و تکرار آن یکی نیستند.'
        ]);

            $code = Str::random();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => bcrypt($request->password),
                'activation_code' => $code,
            ]);
           $encrypted = Crypt::encryptString($code);
        }
        catch (\Exception $ex)
        {
               return redirect()->back()->with(['error'=>$ex->getMessage()]);
        }

        RegisterUserEvent::dispatch($user,$encrypted);

        return redirect()->back()->with(['success'=>'ایمیل فعال سازی برای شما ارسال شد.']);

    }


}
