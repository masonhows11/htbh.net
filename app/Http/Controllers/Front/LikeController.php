<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function postLike(Request $request)
    {
        $sample_id = $request->sample_id;
        $is_like = $request['is_like'] === 'true';
        $user_id = Auth::id();
        $sample = Sample::find($sample_id);
        if (!$sample) {
            return null;
        }
        $like_exists = Like::where('sample_id', '=', $sample_id)->where('user_id', '=', $user_id)->first();
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
            $like->sample_id = $sample_id;
            $like->like = $is_like;
            $like->save();
        }
        $like = Like::where('sample_id', '=', $sample_id)->where('user_id', '=', $user_id)->first();
        if ($like !== null) {
            return response()->json($like);

        }
        if ($like === null) {
            return response()->json($like);
        }
    }

    public function postLikeCount(Request $request)
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

    public function courseLikeCount(Request $request)
    {
        $likes = Like::where('course_id', $request->course_id)
            ->where('like', '=', 1)->count();

        $dislikes = Like::where('course_id', $request->course_id)
            ->where('like', '=', 0)->count();

        return response()
            ->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }
}
