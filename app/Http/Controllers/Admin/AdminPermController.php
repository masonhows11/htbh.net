<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Permission;

class AdminPermController extends Controller
{


    public function index()
    {
        $perms = Permission::all();
        return view('admin.perm_management.index')
            ->with('perms',$perms);
    }

    public function store(Request  $request)
    {

        app()->make(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();

         $request->validate([
            'name' => 'required|unique:permissions|max:25',
        ],$messages=[
            'name.required'=>'نام نقش را وارد کنید',
            'name.unique'=>'این نقش تکراری است',
            'name.max'=>'حداکثر ۳۰ کاراکتر'
        ]);

        if(Permission::create(['name'=>$request->name])){
            return redirect()->back()->with('success','مجوز مورد نظر ذخیره شد');
        }else
        {
            return redirect()->back()->with('error','خطا در ذخیره سازی');
        }

    }
    public function edit(Request $request)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();

        $perm = Permission::findById($request->perm);
        return view('admin.perm_management.edit_perm')->with('perm',$perm);
    }

    public function update(Request $request)
    {

        app()->make(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();

        $perm = Permission::findById($request->id);
        if(!$perm){
            return redirect()->back()->with('error','مجوز مورد نظر وجود ندارد');
        }
        DB::table('permissions')
            ->where('id',$perm->id)
            ->update(['name'=>$request->name]);
        return  redirect()->route('perms')->with('success','بروز رسانی با موفقیت انجام شد.');

    }
    protected function delete(Request $request)
    {

        DB::table('permissions')->where('id',$request->perm)->delete();
        return  redirect()->route('perms')->with('success','مجوز مورد نظر با موفقیت حذف شد.');

    }
}
