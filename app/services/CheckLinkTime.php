<?php


namespace App\services;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class CheckLinkTime
{
    public static function checkLinkExpireTime($id,$code)
    {

       $decrypted_code = Crypt::decryptString($code);

        $link = DB::table('users')
            ->where('activation_code', '=', $decrypted_code)
            ->where('id', '=', $id)->select('created_at')->first();

        $expired  = Carbon::parse($link->created_at)->addMinutes(60)->isPast();
        if($expired)
        {
            return  true;
        }

        return false;

    }
}
