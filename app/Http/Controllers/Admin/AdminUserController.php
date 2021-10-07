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
        try {
            User::where('id',$request->user)
                ->update(['name'=>$request->safe()->name,
                    'first_name'=>$request->safe()->first_name,
                    'last_name'=>$request->safe()->last_name,
                    'email'=>$request->safe()->email]);
            return redirect(route('users'))->with('success','کاربر با موفقیت ویرایش شد.');
        }catch (\Exception $ex)
        {
            return $ex->getMessage();
        }


    }

    public function delete(Request $request)
    {
        $user = User::find($request->user_id);
        if(!$user){
            return response()->json(['warning' => 'کاربر مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            User::destroy($request->user_id);
            return response()->json(['success' => 'کاربر مورد نظر با موفقیت حذف شد.', 'status' => 200], 200);
        }catch (\Exception $ex)
        {
            return response()->json(['exception'=>$ex->getMessage(),'status'=>500],500) ;
        }

    }
}
