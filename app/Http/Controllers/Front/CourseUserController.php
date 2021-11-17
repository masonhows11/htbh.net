<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CourseUser;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseUserController extends Controller
{
    //

    public function addCourseToUser(Request $request)
    {
       //return $request;

       $lessons = Lesson::where('course_id',$request->course)->select('id')->get();

       return $lessons;
    }


}
