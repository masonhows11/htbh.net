<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminRoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.role_management.roles')->with('roles', $roles);
    }

    public function store(Request $request)
    {

             $request->validate([
            'name' => 'required|unique:roles|max:30',
        ], $messages = [
            'name.required' => 'نام نقش را وارد کنید',
            'name.unique' => 'این نقش تکراری است',
            'name.max' => 'حداکثر ۳۰ کاراکتر'
        ]);

        try {
            Role::create(['name' => $request->name]);
            return redirect()->back()->with('success', 'نقش مورد نظر ذخیره شد');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }

        return redirect()->back()->with('error', 'خطا در ذخیره سازی');


    }

    public function edit(Request $request)
    {
        $role = Role::findById($request->role);

        return view('admin.role_management.edit')->with('role', $role);
    }

    public function update(Request $request)
    {
        $role = Role::findById($request->id);
        if (!$role) {
            return redirect()->back()->with('error', 'نقش مورد نظر وجود ندارد');
        }
             $request->validate([
            'name' => 'required|unique:roles|min:5',
        ], $messages = [
            'name.required' => 'نام نقش را وارد کنید',
            'name.unique' => 'این نقش تکراری است',
            'name.max' => 'حداقل ۵ کاراکتر'
        ]);

        try {
            DB::table('roles')
                ->where('id', $role->id)
                ->update(['name' => $request->name]);
            return redirect()->route('roles')->with('success', 'بروز رسانی با موفقیت انجام شد.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }

        return redirect()->back()->with(['error'=>'خطا در بروز رسانی ']);



    }

    protected function delete(Request $request)
    {

        $role = Role::findById($request->role_id);
        if(!$role){
            return response()->json(['warning' => 'نقش مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            Role::destroy($request->role_id);
            return response()->json(['success' => 'نقش مورد نظر با موفقیت حذف شد.', 'status' => 200], 200);
        }catch (\Exception $ex)
        {
            return response()->json(['exception'=>$ex->getMessage(),'status'=>500],500) ;
        }

    }

}
