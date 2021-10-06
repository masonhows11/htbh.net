<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    public function index()
    {

        $users = User::all();
        return view('admin.users.users')
            ->with('users',$users);

    }

    public function edit(Request $request)
    {
        return $request;
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {
        return $request;
    }
}
