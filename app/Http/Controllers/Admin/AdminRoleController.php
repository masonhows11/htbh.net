<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminRoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return view('admin.role_management.roles')->with('roles',$roles);
    }

    public function store(Request  $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:roles|max:30',
        ],$messages=[
            'name.required'=>'نام نقش را وارد کنید',
            'name.unique'=>'این نقش تکراری است',
            'name.max'=>'حداکثر ۳۰ کاراکتر'
        ]);

        if(Role::create(['name'=>$request->name])){
            return redirect()->back()->with('success','نقش مورد نظر ذخیره شد');
        }else
        {
            return redirect()->back()->with('error','خطا در ذخیره سازی');
        }

    }
    public function edit(Request $request)
    {
        $role = Role::findById($request->role);

        return view('admin.role_management.edit_role')->with('role',$role);
    }

    public function update(Request $request)
    {
        $role = Role::findById($request->id);

        if(!$role){
            return redirect()->back()->with('error','نقش مورد نظر وجود ندارد');
        }
        DB::table('roles')
            ->where('id',$role->id)
            ->update(['name'=>$request->name]);
        return  redirect()->route('roles')->with('success','بروز رسانی با موفقیت انجام شد.');

    }
    protected function delete(Request $request)
    {

        DB::table('roles')->where('id',$request->role)->delete();
        return  redirect()->route('roles')->with('success','نقش مورد نظر با موفقیت حذف شد.');

    }

}
