<?php

namespace App\Http\Controllers\Auth;

use App\Events\ResetPassUserEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class ResetPasswordController extends Controller
{
    //

    public function resetPassForm()
    {
        return view('auth.reset_pass_form');
    }

    public function resetPassCheckEmail(Request $request)
    {
        //return $request;
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

    public function resetPassHandleForm(Request $request)
    {
        return $request;
    }

    public function resetPassHandle(Request $request)
    {
        return $request;
    }
}
