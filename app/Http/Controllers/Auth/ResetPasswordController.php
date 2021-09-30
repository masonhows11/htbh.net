<?php

namespace App\Http\Controllers\Auth;

use App\Events\ResetPassUserEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\services\CheckLinkResetPassTime;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    //

    public function resetPassForm()
    {
        return view('auth.reset_password.reset_pass_form');
    }

    public function resetPassCheckEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ], $messages = [
            'email.required' => 'ایمیل خود را وارد کنید.',
            'email.email' => 'ایمیل وارد شده معتبر نمی باشد.',
            'email.exists' => 'ایمیل وارد شده وجود ندارد.'
        ]);
        $user = User::where('email', $request->email)->first();
        $token = Str::random(30);
        try {
            DB::table('password_resets')
                ->insert(['email'=>$request->email,
                    'token' => $token,
                    'created_at'=>Carbon::now()]);

            ResetPassUserEvent::dispatch($user, $token);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
        return  redirect()->back()->with('success','لینک تغییر رمز عبور با موفقیت ارسال شد.');

    }

    public function resetPassHandleForm($token,$email)
    {

         $isValid = CheckLinkResetPassTime::checkResetLinkExpire($email,$token);
         if(!$isValid){
             return redirect(route('resetPassForm'))
                 ->with('error','لینک تغییر رمز عبور معتبر نمی باشد.');
         }
         $user = User::where('email',$email)->first();
         return view('auth.reset_password.reset_pass_handle_form')
             ->with(['user'=>$user]);


    }

    public function resetPassHandle(Request $request)
    {

        $request->validate([
            'password'=>['required','confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ], $messages = [
            'password.required' => 'رمز عبور را وارد کنید.',
            'password.min' => 'حداقل تعداد کاراکتر رمز عبور ۸ کاراکتر.',
            'password.confirmed' => 'رمز عبور و تکرار آن یکی نیستند.'
        ]);
        try {
            $user = User::where('email',$request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
        }catch (\Exception $ex)
        {
            return $ex->getMessage();
        }
        return redirect(route('loginForm'))->with('success','رمز عبور با موفقیت تغییر کرد.');


    }
}
