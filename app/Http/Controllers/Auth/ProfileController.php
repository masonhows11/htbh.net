<?php

namespace App\Http\Controllers\Auth;

use App\Events\ChangeUserEmailEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\services\CheckLinkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile')->with('user', $user);
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'کاربری با این مشخصات وجود ندارد.');
        }
        $request->validate([
            'first_name' => 'nullable|min:5',
            'last_name' => 'nullable|min:5',
            'name' => ['nullable', 'min:5', Rule::unique('users')->ignore($user->id)]
        ], $messages = [
            'first_name.min' => 'نام حداقل ۱۰ کاراکتر باشد.',
            'last_name.min' => 'نام خانوادگی حداقل ۱۰ کاراکتر باشد.',
            'name.min' => 'نام کاربری حداقل ۱۰ کاراکتر باشد.',
        ]);
        try {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $request->name;
            $user->save();

            return redirect()->back()->with('success', 'پروفایل با موفقیت بروزرسانی شد.');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }


    }

    public function editEmailForm(Request $request)
    {
        $user = User::where('email', $request->user)->first();
        return view('auth.edit_email')->with('user', $user);
    }

    public function editEmail(Request $request)
    {
        $user = User::where('email', $request->old_email)->first();

        $request->validate([
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($user->id)]
        ], $messages = [
            'email.email' => 'آدرس ایمیل وارد شده معتبر نمی باشد.',
        ]);
        try {

            $code = Str::random();
            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->activation_code = $code;
            $user->save();
            $encrypted = Crypt::encryptString($code);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

        ChangeUserEmailEvent::dispatch($user,$encrypted);

        Auth::logout();
        $request->session()->invalidate();
        return redirect('/loginForm')->with('success', 'لینک فعال سازی برای شما ارسال شد.');
    }

    public function confirmEditEmail($id,$code)
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
                return redirect()->route('loginForm')->with('success', 'آدرس ایمیل شما با موفقیت تغییر کرد.');
            }
        }
        return redirect()->route('loginForm')->with('error','لینک فعال سازی معتبر نمی باشد.');
    }
}
