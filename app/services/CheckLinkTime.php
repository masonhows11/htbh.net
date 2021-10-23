<?php


namespace App\services;


use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class CheckLinkTime
{
    public static function checkLinkExpireTime($id, $code)
    {

        try {
            $decrypted_code = Crypt::decryptString($code);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $link = DB::table('users')
            ->where('activation_code', '=', $decrypted_code)
            ->where('id', '=', $id)
            ->select('created_at')->first();
        if (!$link) {
          return false;
        }
        if ($link) {
            $expired = Carbon::parse($link->created_at)->addMinutes(1)->isPast();
            if ($expired) {
              return false;
            }
        }
       return true;
    }

    public static function checkLinkExpireEditEmail($id, $code)
    {
        try {
            $decrypted_code = Crypt::decryptString($code);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        $link = DB::table('users')
            ->where('activation_code', '=', $decrypted_code)
            ->where('id', '=', $id)
            ->select('updated_at')->first();
        if (!$link) {
            return false;
        }
        if ($link) {
            $expired = Carbon::parse($link->updated_at)->addMinutes(1)->isPast();
            if ($expired) {
                return false;
            }
        }
        return true;
    }

}
