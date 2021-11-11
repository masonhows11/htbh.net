<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{

    public function course($course)
    {
        try {
            $course =
                Course::with(['categories', 'likes', 'seasons.lessons', 'comments'
                => function ($query) {
                        $query->where('approved', 1);
                    }])->where('slug', '=', $course)->first();
            return view('front.course_page.course')->with('course', $course);

        } catch (\Exception $ex) {
            return view('errors.error_not_found_model');
        }

    }

    public function lessonDetail($lesson)
    {
        //return $lesson;
        return view('front.course_page.lesson');
    }
}
