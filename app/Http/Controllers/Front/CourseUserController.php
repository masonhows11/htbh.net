<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CourseUser;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CourseUserController extends Controller
{
    //

    public function addCourseToUser(Request $request): \Illuminate\Http\RedirectResponse
    {

        $lessons = Lesson::where('course_id', $request->course)->select('id')->get();
        $course_id = $request->course;

        

        foreach ($lessons as $i => $iValue) {
            $courseUser = new CourseUser();
            $courseUser->user_id = Auth::id();
            $courseUser->lesson_id = $lessons[$i]['id'];
            $courseUser->course_id = $course_id;
            $courseUser->save();
        }

        return redirect()->back();
    }


}
