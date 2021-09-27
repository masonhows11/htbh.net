<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        //return $request;

        $request->validate([
            'name'=>'required|max:30|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>['required','confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],//],
        ],$messages = [
            'name.unique' => 'این نام کاربری تکراری است',
            'name.required' => 'نام کاربری را وارد کنید ',
            'email.required' => 'آدرس ایمیل را وارد کنید',
            'email.unique' => 'این ایمیل تکراری است',
            'password.required' => 'رمز عبور را وارد کنید',
            'password.mixedCase' => 'رمز عبور باید شامل حداقل یک کاراکتر بزرگ و یک کاراکتر کوچک باشد.',
            'password.min' => 'حداقل تعداد کاراکتر رمز عبور ۸ کاراکتر',
            'password.confirmed' => 'رمز عبور و تکرار آن یکی نیستند'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'activation_code' => Str::random(40),
            ]);
        }
        catch (\Exception $ex)
        {
               return redirect()->back()->with(['error'=>$ex->getMessage()]);
        }

        RegisterUserEvent::dispatch($user);

        return redirect()->back()->with(['success'=>'ایمیل فعال سازی برای شما ارسال شد.']);

    }


}
