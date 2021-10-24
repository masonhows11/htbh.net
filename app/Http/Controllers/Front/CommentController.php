<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // return $request;

        $request->validate([
            'description' => 'required|min:20|max:400'

        ],$messages = [
            'description.required' => 'متن دیدگاه را وارد کنید.',
            'description.min' => 'متن دیدگاه باید حداقل 20 کاراکتر باشد.',
        ]);

        if($request->filled('post_id')){

            Comment::create([
                'user_name' => Auth::user()->user_name,
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'post_id' => $request->post_id,
                'description'=> $request->description
            ]);
        }

        if ($request->filled('course_id')){
            Comment::create([
                'user_name' => Auth::user()->user_name,
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'course_id' => $request->course_id,
                'description'=> $request->description
            ]);
        }


        return redirect()->back()->with('message','دیدگاه شما با موفقیت ثبت شد، پس از بررسی نمایش داده خواهد شد.');


    }
}
