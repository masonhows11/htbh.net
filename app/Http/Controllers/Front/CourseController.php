<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
class CourseController extends Controller
{
    //

    public function course($course)
    {
        // return $course;

        $course = Course::with('lessons','user')
            ->where('slug','=',$course)->get();
        return $course;

    }
}
