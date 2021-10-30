<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCommentController extends Controller
{

    public function getCourses()
    {
        $categories = Category::all();
        $courses = Course::all();
        return view('admin.comment_management.courses')
            ->with(['categories' => $categories, 'courses' => $courses]);
    }

    public function getCoursesCategory(Request $request)
    {

        $categories = Category::all();
        try {
            $courses =
                DB::table('courses')
                    ->join('category_course', 'courses.id', '=', 'category_course.course_id')
                    ->join('categories', 'categories.id', '=', 'category_course.category_id')
                    ->select('courses.*')
                    ->where('categories.id', '=', $request->category)
                    ->orderBy('created_at', 'asc')->get();
            return view('admin.comment_management.courses')
                ->with(['categories' => $categories, 'courses' => $courses]);
        } catch (\Exception $ex) {
            return view('errors.error_not_found_model.blade');
        }

    }

    public function getCourseComments(Request $request)
    {


        $course_id = $request->course;
        $comments =
            Course::with(['comments' => function ($query) use ($course_id) {
                $query->where('course_id', '=', $course_id);
            }])->where('id', $course_id)
                ->get();
        return view('admin.comment_management.comments')
            ->with(['comments' => $comments]);

    }


    public function getPostsComments()
    {
        return view('admin.comment_management.posts');
    }


}
