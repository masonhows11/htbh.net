<?php

namespace App\Http\Controllers\Auth;


use App\Events\RegisterUserEvent;
use App\Http\Controllers\Controller;
use App\services\CheckLinkTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class VerifyEmailController extends Controller
{
    //
    public function verifyEmail($id, $code)
    {

        $isValid = CheckLinkTime::checkLinkExpireTime($id, $code);
        $decrypted_code = Crypt::decryptString($code);
        if ($isValid == true) {
            $user = User::where('id', $id)->where('activation_code', $decrypted_code)->first();
            if (!$user) {
                return redirect()->route('loginForm')->with('error', 'کاربر مورد نظر پیدا نشد.');
            } elseif ($user && $user->email_verified_at != null) {
                return redirect()->route('loginForm')->with('error', 'این ایمیل قبلا تایید شده.');
            } elseif ($user && $user->email_verified_at == null) {
                $user->email_verified_at = Date::now();
                $user->save();
                return redirect()->route('loginForm')->with('success', 'حساب کاربری شما با موفقیت فعال شد.');
            }
        }


        return redirect()->route('loginForm')->with('error','لینک فعال سازی معتبر نمی باشد.');


    }

    public function resendVerifyEmailForm()
    {
        return view('auth.resend_verify_email_form');
    }

    public function checkEmailVerify(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users'
        ],$messages = [
            'email.required'=>'ایمیل خود را وارد کنید.',
            'email.email'=>'ایمیل وارد شده معتبر نمی باشد.',
            'email.exists'=>'ایمیل وارد شده وجود ندارد.'
        ]);
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return redirect()->back()->with(['error'=>'کاربری با ایمیل وارد شده .جود ندارد.']);
        }
        try {
            if($user){
                $code = Str::random();
                $user->activation_code = $code;
                $user->created_at = Carbon::now();
                $user->save();
                $encrypted = Crypt::encryptString($code);
                RegisterUserEvent::dispatch($user,$encrypted);
                return redirect(route('registerForm'))->with(['success'=>'ایمیل فعال سازی برای شما ارسال شد.']);
            }
        }catch (\Exception $ex){
            return redirect()->back()->with(['error'=>$ex->getMessage()]);
        }

    }
}
