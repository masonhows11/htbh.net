<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\services\GetImageName;

class AdminPostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.post_management.index')
            ->with(['posts' => $posts,
                'categories' => $categories]);
    }

    public function listPostBaseCategory(Request $request)
    {


        $request->validate([
            'category' => 'required|exists:categories,name'
        ], $message = [
            'category.required' => 'یک دسته بندی انتخاب کنید.',
            'category.exists' => 'دسته بندی مورد نظر وجود ندارد.',
        ]);
        $categories = Category::all();


        if ($request->filled('category')) {
            try {


            } catch (\Exception $ex) {

            }
        }

    }

    public function create()
    {

        $categories = Category::all();
        return view('admin.post_management.create')->with(['categories' => $categories]);

    }


    public function store(Request $request)
    {


        $request->validate([
            'category' => 'required',
            'title' => 'required|min:3|max:50',
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:10',
            'image' => 'required',
        ], $message = [
            'category.required' => 'یک دسته بندی انتخاب کنید.',
            'title.required' => 'عنوان مقاله الزامی است.',
            'title.min' => 'حداقل ۵ کاراکتر.',
            'title.max' => 'حداکثر ۴۰ کاراکتر.',
            'name.required' => 'نام مقاله الزامی است.',
            'name.min' => 'حداقل ۵ کاراکتر.',
            'name.max' => 'حداکثر ۴۰ کاراکتر.',
            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'حداقل ۱۰ کاراکتر',
            'image.required' => 'انخاب عکس الزامی است.',
        ]);

      
        $categories = Category::all();
        try {

        $image_name = GetImageName::getName($request->image);
        Post::create([
            'title'=>$request->title,
            'name'=>$request->name,
            'description' => $request->description,
            'image'=> $image_name,
        ])->categories()->sync($request->category);

        return redirect()
            ->route('articles')
            ->with(['categories'=>$categories,'success'=>'مقاله جدید با موفقیت ایجاد شد.']);

        } catch (\Exception $ex) {
            return view('errors.error_store_model');
        }

    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function confirm(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }


}
