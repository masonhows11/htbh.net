<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
    //
    public function loginForm()
    {
        return view('auth.login_user');
    }

    public function login(Request $request)
    {

    }
    public function profile()
    {
        return view('auth.profile');
    }
}
