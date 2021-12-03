<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\services\GetImageName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPostController extends Controller
{

    public function index()
    {

        $posts = Post::orderBy('created_at', 'asc')->Paginate(3);
        return view('admin.post_management.index')
            ->with(['posts' => $posts]);
    }


    public function create()
    {

        return view('admin.post_management.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:10',
            'image' => 'required',
        ], $message = [
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

         return $request->image;
        try {
            $image_name = GetImageName::articleName($request->image);
            Post::create([
                'title' => $request->title,
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image_name,
                'user_id' => Auth::id(),
            ]);

            return redirect()
                ->route('articles')
                ->with(['success' => 'مقاله جدید با موفقیت ایجاد شد.']);

        } catch (\Exception $ex) {
            return view('errors.error_store_model');
        }

    }

    public function edit(Request $request)
    {
        try {
            $post = Post::findOrFail($request->post);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'مقاله مورد نظر وجود ندارد.']);
        }
        //$categories = Category::all();
        return view('admin.post_management.edit')
            ->with(['post' => $post]);

    }

    public function update(Request $request)
    {

        $request->validate([

            'title' => 'required|min:3|max:50',
            'name' => 'required|min:3|max:30',
            'description' => 'required|min:10',
            'image' => 'required',
        ], $message = [

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
        try {
            $image_name = GetImageName::getName($request->image);
            $post = Post::findOrFail($request->id);
            $post->title = $request->title;
            $post->name = $request->name;
            $post->description = $request->description;
            $post->image = $image_name;
            $post->save();
            //$post->categories()->sync($request->category);

            return redirect(route('articles'))
                ->with(['success' => 'مقاله  با موفقیت ویرایش شد.']);

        } catch (\Exception $ex) {
            return view('errors.error_store_model');
        }


    }

    public function confirm(Request $request)
    {


        $post = Post::find($request->post_id);
        if (!$post) {
            return response()->json(['error' => 'مقاله مورد نظر وجود ندارد.', 'status' => 404], 404);
        }
        try {

            if ($post->approved == 0) {
                $post->approved = 1;
            } else {
                $post->approved = 0;
            }
            $post->save();
            $approved = $post->approved;
            return response()->json(['success' => '.وضعیت انتشار با موفقیت تغییر کرد', 'publish' => $approved, 'status' => 200], 200);

        } catch (\Exception $ex) {
            return response()->json(['error' => '.عملیات انتشار انجام نشد', 'status' => 500], 500);
        }
    }

    public function delete(Request $request)
    {

        $post = Post::find($request->post_id);
        if (!$post) {
            return response()->json(['warning' => 'مقاله مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            Post::destroy($request->post_id);
            return response()->json(['success' => 'مقاله نظر با موفقیت حذف شد.', 'status' => 200], 200);
        } catch (\Exception $ex) {
            return response()->json(['exception' => $ex->getMessage(), 'status' => 500], 500);
        }
    }


}
