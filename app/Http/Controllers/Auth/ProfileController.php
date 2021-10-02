<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile')->with('user',$user);
    }

    public function updateProfile(Request $request)
    {
        //return $request;
        $user = User::where('email',$request->email)->first();
        if(!$user)
        {
            return redirect()->back()->with('error','کاربری با این مشخصات وجود ندارد.');
        }

        $request->validate([
            'first_name' => 'nullable|min:5',
            'last_name'=> 'nullable|min:5',
            'name' => ['nullable','min:5',Rule::unique('users')->ignore($user->id)]
        ],$messages =[
            'first_name.min'=> 'نام حداقل ۱۰ کاراکتر باشد.',
            'last_name.min'=>'نام خانوادگی حداقل ۱۰ کاراکتر باشد.',
             'name.min' => 'نام کاربری حداقل ۱۰ کاراکتر باشد.',
        ]);

        try {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $request->name;
            $user->save();

            return redirect()->back()->with('success','پروفایل با موفقیت بروزرسانی شد.');
        }catch (\Exception $ex)
        {
            return $ex->getMessage();
        }


    }

    public function editEmailForm()
    {

    }

    public function editEmail(Request $request)
    {

    }
}
