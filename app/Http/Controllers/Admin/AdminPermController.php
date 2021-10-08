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
        return view('admin.perm_management.perms')
            ->with('perms',$perms);
    }

    public function store(Request  $request)
    {

        app()->make(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();

         $request->validate([
            'name' => 'required|unique:permissions|min:5',
        ],$messages=[
            'name.required'=>'نام مجوز را وارد کنید',
            'name.unique'=>'این مجوز تکراری است',
            'name.min'=>'حداکثر ۵ کاراکتر'
        ]);

        try {
            Permission::create(['name'=>$request->name]);
            return redirect()->back()->with('success','مجوز مورد نظر ذخیره شد');
        }catch (\Exception $ex)
        {
            return redirect()->back()->with('error',$ex->getMessage());
        }
        return redirect()->back()->with('error','خطا در ذخیره سازی');

    }
    public function edit(Request $request)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();

        $perm = Permission::findById($request->perm);
        return view('admin.perm_management.edit')->with('perm',$perm);
    }

    public function update(Request $request)
    {

        app()->make(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();

        $perm = Permission::findById($request->id);
        if(!$perm){
            return redirect()->back()->with('error','مجوز مورد نظر وجود ندارد');
        }
        $request->validate([
            'name' => 'required|unique:permissions|min:5',
        ],$messages=[
            'name.required'=>'نام مجوز را وارد کنید',
            'name.unique'=>'این مجوز تکراری است',
            'name.min'=>'حداکثر ۵ کاراکتر'
        ]);
        try {
            DB::table('permissions')
                ->where('id',$perm->id)
                ->update(['name'=>$request->name]);
            return  redirect()->route('perms')->with('success','بروز رسانی با موفقیت انجام شد.');
        }catch (\Exception $ex)
        {
            return redirect()->back()->with('error', $ex->getMessage());
        }
        return redirect()->back()->with(['error'=>'خطا در بروز رسانی ']);

    }
    protected function delete(Request $request)
    {

        $perm = Permission::findById($request->perm_id);
        if(!$perm){
            return response()->json(['warning' => 'نقش مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            Permission::destroy($request->perm_id);
            return response()->json(['success' => 'نقش مورد نظر با موفقیت حذف شد.', 'status' => 200], 200);
        }catch (\Exception $ex)
        {
            return response()->json(['exception'=>$ex->getMessage(),'status'=>500],500) ;
        }

    }
}
