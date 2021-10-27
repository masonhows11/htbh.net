<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    //

    public function getPostsComments()
    {
        return view('admin.comment_management.posts');
    }

    public function getCoursesComments()
    {
        return view('admin.comment_management.courses');

    }
}
