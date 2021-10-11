<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        $parent_categories = Category::where('parent_id', null)->get();
        return view('admin.post_management.index')
            ->with('parent_categories',$parent_categories);


    }

    public function create()
    {

    }

    public function store(Request $request){

    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function confirm(Request $request){

    }

    public function delete(Request $request)
    {

    }




}
