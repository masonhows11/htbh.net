<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Post;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
            Course::with(['comments','categories' => function ($query) use ($course_id) {
                $query->where('course_id', '=', $course_id);
            }])->where('id', $course_id)
                ->get();
        return view('admin.comment_management.course_comments')
            ->with(['comments' => $comments]);

    }

    public function approvedComment(Request $request){


        $comment = Comment::find($request->comment_id);

        if (!$comment) {
            return response()->json(['error' => 'دیدگاه مورد نظر وجود ندارد.', 'status' => 404], 404);
        }
        try {

            if ($comment->approved == 0) {
                $comment->approved = 1;
            } else {
                $comment->approved = 0;
            }
            $comment->save();
            $approved = $comment->approved;
            return response()->json(['success' => 'وضعیت انتشار با موفقیت تغییر کرد.', 'publish' => $approved, 'status' => 200], 200);

        } catch (\Exception $ex) {
            return response()->json(['error' => '.عملیات انتشار انجام نشد', 'status' => 500], 500);
        }
    }

    public function deleteComment(Request $request){


        $comment = Comment::find($request->comment_id);
        if (!$comment) {
            return response()->json(['warning' => 'دیدگاه مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            Comment::destroy($request->comment_id);
            return response()->json(['success' => 'دیدگاه با موفقیت حذف شد.', 'status' => 200], 200);
        } catch (\Exception $ex) {
            return response()->json(['exception' => $ex->getMessage(), 'status' => 500], 500);
        }
    }
    public function getPosts()
    {
        $posts = Post::all();
        return view('admin.comment_management.posts')->with(['posts'=>$posts]);
    }

    public function getPostComments(Request $request)
    {
        $post_id = $request->post;
        $comments =
            Post::with(['comments' => function ($query) use ($post_id) {
                $query->where('post_id', '=', $post_id);
            }])->where('id', $post_id)
                ->get();
        return view('admin.comment_management.post_comments')
            ->with(['comments' => $comments]);
    }


}
