<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    //
    public function getCoursesComments()
    {
        $categories = Category::all();
        return view('admin.comment_management.courses')
            ->with('categories',$categories);
    }
    public function getPostsComments()
    {
        return view('admin.comment_management.posts');
    }


}
