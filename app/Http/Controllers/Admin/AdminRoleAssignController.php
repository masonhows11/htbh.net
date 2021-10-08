<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminRoleAssignController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.role_assignment.index')
            ->with('users',$users);
    }

    public function assignForm(Request $request)
    {
        $user = User::findOrFail($request->user);
        $roles = Role::all();

        return view('admin.role_assignment.assign')
            ->with(['user'=>$user,'roles'=>$roles]);
    }

    public function assign(Request $request)
    {

        $user = User::findOrFail($request->id);

        try {
            $user->syncRoles($request->roles);
            return redirect()->route('listUsers')
                ->with('success','تخصیص نقش ها با موفقیت انجام شد.');
        }catch (\Exception $ex)
        {
            return redirect()->route('listUsers')
                ->with('error',$ex->getMessage());
        }
            return redirect()->route('listUsers')->with('error','خطا در تخصیص نقش ها');
    }

}
