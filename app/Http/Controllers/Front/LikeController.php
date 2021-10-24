<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function postLike(Request $request)
    {
        $post_id = $request->post_id;
        $is_like = $request['is_like'] === 'true';
        $user_id = Auth::id();
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $like_exists = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();
        if ($like_exists) {
            $already_like = $like_exists->like;

            if ($already_like == $is_like) {
                $like_exists->delete();

            } elseif ($already_like != $is_like) {
                $like_exists->like = $is_like;
                $like_exists->save();

            }
        } else {
            $like = new Like();
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->like = $is_like;
            $like->save();
        }
        $like = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();
        if ($like !== null) {
            return response()->json($like);

        }
        if ($like === null) {
            return response()->json($like);
        }
    }

    public function postLikeCount(Request $request): \Illuminate\Http\JsonResponse
    {

        $likes = Like::where('sample_id', $request->sample_id)
            ->where('like', '=', 1)->count();

        $dislikes = Like::where('sample_id', $request->sample_id)
            ->where('like', '=', 0)->count();

        return response()
            ->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }


    public function courseLike(Request $request)
    {
        $course_id = $request->course_id;
        $is_like = $request['is_like'] === 'true';
        $user_id = Auth::id();
        $course = Course::find($course_id);
        if (!$course) {
            return null;
        }
        $like_exists = Like::where('course_id', '=', $course_id)->where('user_id', '=', $user_id)->first();
        if ($like_exists) {
            $already_like = $like_exists->like;

            if ($already_like == $is_like) {
                $like_exists->delete();

            } elseif ($already_like != $is_like) {
                $like_exists->like = $is_like;
                $like_exists->save();

            }
        } else {
            $like = new Like();
            $like->user_id = $user_id;
            $like->course_id = $course_id;
            $like->like = $is_like;
            $like->save();
        }
        $like = Like::where('course_id', '=', $course_id)->where('user_id', '=', $user_id)->first();
        if ($like != null) {
            return response()->json($like);

        }
        if ($like == null) {
            return response()->json($like);
        }

    }

    public function courseLikeCount(Request $request): \Illuminate\Http\JsonResponse
    {
        $likes = Like::where('course_id', $request->course_id)
            ->where('like', '=', 1)->count();

        $dislikes = Like::where('course_id', $request->course_id)
            ->where('like', '=', 0)->count();

        return response()
            ->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }
}
