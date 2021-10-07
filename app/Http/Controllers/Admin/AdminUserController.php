<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditUserRequest;
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
        $user = User::findOrFail($request->user);
        return view('admin.users.edit')
            ->with('user',$user);

    }


    public function update(AdminEditUserRequest $request)
    {

        $validated = $request->validated();
        return $validated;

    }

    public function delete(Request $request)
    {
        return $request;
    }
}
