<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\services\CheckLinkTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;

class VerifyEmailController extends Controller
{
    //
    public function verifyEmail($id, $code)
    {

        $isValid = CheckLinkTime::checkLinkExpireTime($id, $code);

        $decrypted_code = Crypt::decryptString($code);

        if ($isValid) {
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
        return view('auth.resend_verify_email');
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

            return $request;
    }
}
