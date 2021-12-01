<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
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
    public function lessonDetail(Request $request)
    {

        $lesson = Lesson::with('course')
            ->where('id','=',$request->id)->get();
        return view('front.course_page.lesson')
            ->with(['lesson'=>$lesson]);


    }

    public function coursesCategory($category)
    {
        $categories = Category::where('parent_id', null)->get();
        $courses = Course::with('categories')
            ->join('category_course', 'courses.id', '=', 'category_course.course_id')
            ->join('categories', 'categories.id', '=', 'category_course.category_id')
            ->where('categories.name', '=', $category)->where('courses.status_publish','=',1)->select('courses.*')->get();

        return view('front.course_page.courses_category')
            ->with(['courses' => $courses, 'categories' => $categories]);
    }
}
