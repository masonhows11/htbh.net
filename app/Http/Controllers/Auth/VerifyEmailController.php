<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\services\CheckLinkTime;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;

class VerifyEmailController extends Controller
{
    //
    public function verifyEmail($id, $code)
    {

        $isValid = CheckLinkTime::checkLinkExpireTime($id, $code);

        $decrypted_code = Crypt::decrypt($code);

        if ($isValid) {
            $user = User::where('id', $id)->where('activation_code', $decrypted_code)->first();
            if (!$user) {
                return redirect()->route('loginForm')->with('error', 'کاربر مورد نظر پیدا نشد.');
            } elseif ($user && $user->email_verified_at != null) {
                return redirect()->route('loginForm')->with('error', 'این ایمیل قبلا تایید شده.');
            } elseif ($user && $user->email_verified_at == null) {
                $user->email_verified_at = Date::now();
                $user->save();
                return redirect()->route('loginForm')->with('error', 'حساب کاربری شما با موفقیت فعال شد.');
            }
        }


        return redirect()->route('loginForm')->with('error','لینک فعال سازی معتبر نمی باشد.');


    }
}
