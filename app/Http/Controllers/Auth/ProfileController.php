<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile')->with('user',$user);
    }

    public function updateProfile(Request $request)
    {
        return $request;
    }

    public function editEmailForm()
    {

    }

    public function editEmail(Request $request)
    {

    }
}
