<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseUserController extends Controller
{
    //

    public function addCourseToUser(Request $request)
    {
        //return $request;

        $courseUser = CourseUser::create([
            'user_id'=> Auth::id(),
            'course_id' => $request->course,
        ]);
        return redirect()->back();
    }


}
