<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required|min:20|max:400'
        ],$messages = [
            'description.required' => 'متن دیدگاه را وارد کنید.',
            'description.min' => 'متن دیدگاه باید حداقل 20 کاراکتر باشد.',
        ]);
        if($validator->fails()){
            return response()->json(['message'=>$validator->errors(),'status'=>403],200);
        }
        try {
            if($request->filled('post_id')){
                Comment::create([
                    'user_name' => Auth::user()->name,
                    'user_id' => Auth::id(),
                    'email' => Auth::user()->email,
                    'post_id' => $request->post_id,
                    'description'=> $request->description
                ]);
            }
            if ($request->filled('course_id')){
                Comment::create([
                    'user_name' => Auth::user()->name,
                    'user_id' => Auth::id(),
                    'email' => Auth::user()->email,
                    'course_id' => $request->course_id,
                    'description'=> $request->description
                ]);
            }
            return response()->json(['message'=>'دیدگاه شما با موفقیت ثبت شد، پس از بررسی نمایش داده خواهد شد.','status'=>200],200);
        }catch (\Exception $ex)
        {
            return response()->json(['message'=>'خطایی در ثبت دیدگاه رخ داد.!','status'=>500],500);
        }
    }
}
