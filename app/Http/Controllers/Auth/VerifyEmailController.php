<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

class VerifyEmailController extends Controller
{
    //
    public function verifyEmail($id,$code)
    {
        return $code.$id;
    }
}
