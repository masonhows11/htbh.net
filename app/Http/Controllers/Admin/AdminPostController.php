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
        $categories = Category::all();
        return view('admin.post_management.index')
            ->with(['posts'=>$posts,
                'categories'=>$categories]);
    }

    public function listPostBaseCategory(Request $request)
    {
        //return $request;
        $request->validate([
            'category' => 'required|exists:categories,name'
        ],$message = [
            'category.required'=>'یک دسته بندی انتخاب کنید.',
            'category.exists'=>'دسته بندی مورد نظر وجود ندارد.',
        ]);

        if ($request->filled('category')) {
            try
            {

            }catch (\Exception $ex){

            }
        }

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
