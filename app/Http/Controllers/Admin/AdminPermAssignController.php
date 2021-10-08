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
        if(!$role)
        {
            return  redirect()->back()->with('error','نقش مورد نظر وجود ندارد.');
        }
        try {
            $role->syncPermissions($request->perms);
            return redirect()->route('listRoles')
                ->with('success','بروز رسانی مجوز با موفقیت انجام شد.');
        }catch (\Exception $ex)
        {
            return redirect()->route('listRoles')
                ->with('error',$ex->getMessage());
        }

        return redirect()->route('listRoles')->with('error','خطا در تخصیص مجوزها');

    }
}
