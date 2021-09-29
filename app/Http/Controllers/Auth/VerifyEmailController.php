<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\services\CheckLinkTime;
class VerifyEmailController extends Controller
{
    //
    public function verifyEmail($id,$code)
    {

     $isValid =  CheckLinkTime::checkLinkExpireTime($id,$code);

     if($isValid)
     {
                
     }


    }
}
