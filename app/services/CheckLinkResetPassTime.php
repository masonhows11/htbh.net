<?php


namespace App\services;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckLinkResetPassTime
{

    public static function checkResetLinkExpire($email,$token)
    {

        $resetLink = DB::table('password_resets')
            ->where('email',$email)->where('token',$token)
            ->select('created_at')->first();
        if(!$resetLink){
            // means link not valid
            return false;
        }

        if ($resetLink){
            $expired = Carbon::parse($resetLink->created_at)->addMinutes(1)->isPast();
            if($expired){
                // means link not expired
                return false;
            }
        }
        // means link exist and not expired
        return true;


    }

}
