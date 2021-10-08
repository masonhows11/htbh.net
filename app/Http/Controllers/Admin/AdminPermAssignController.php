<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminPermAssignController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return view('admin.perm_assignment.index')
            ->with('roles',$roles);
    }
    public function assignForm(Request $request)
    {
        $role = Role::findById($request->role);
        $perms = Permission::all();
        return view('admin.perm_assignment.assign')
            ->with(['role'=>$role,'perms'=>$perms]);
    }
    public function assign(Request $request)
    {
        $role = Role::findById($request->id);
        if($role->syncPermissions($request->perms)){
            return redirect()->route('listRoles')
                ->with('success','تخصیص مجوز با موفقیت انجام شد.');
        }else
            return redirect()->route('listRoles')
                ->with('error','خطا در تخصیص مجوزها');

    }
}
