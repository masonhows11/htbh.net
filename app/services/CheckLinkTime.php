<?php


namespace App\services;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CheckLinkTime
{
    public static function checkLinkExpireTime()
    {
        $token = $request->route('token');
        $email = $request->route('email');

        $link = DB::table('password_resets')
            ->where('token', '=', $token)
            ->where('email', '=', $email)->select('created_at')->first();

        $expired  = Carbon::parse($link->created_at)->addMinutes(60)->isPast();
        if($expired)
        {
            return  redirect()->route('loginForm')->with('error','لینک منقضی شده است.');
        }

    }
}
