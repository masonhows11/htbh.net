<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function loginForm()
    {
        return view('auth.login_user');
    }

    public function profile()
    {
        return view('auth.profile');
    }
}
