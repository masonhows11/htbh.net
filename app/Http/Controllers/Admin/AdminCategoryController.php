<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{

    public function index()
    {
        $parent_categories = Category::where('parent_id', null)->get();
        $categories = Category::all();
        return view('admin.category_management.index')
            ->with(['categories' => $categories, 'parent_categories' => $parent_categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|min:3',
            'title' => 'required|unique:categories|min:3',

        ], $message = [
            'name.required' => 'نام دسته بندی را وارد کنید',
            'name.unique' => 'این نام تکراری است',
            'name.min' => ' حداکثر ۳ کاراکتر ',
            'title.min' => ' حداکثر ۳ کاراکتر ',
            'title.required' => 'عنوان دسته بندی را وارد کنید',
            'title.unique' => 'این عنوان تکراری است',

        ]);

        if ($request->has('parent')) {
            try {
                Category::create([
                    'name' => $request->name,
                    'title' => $request->title,
                    'parent_id' => $request->parent,
                ]);
                return redirect()->back()->with('success', 'دسته بندی مورد با موفقیت ذخیره شد.');
            } catch (\Exception $ex) {
                    return view('errors.store_error');
            }
        }else {
            try {
                Category::create([
                    'name' => $request->name,
                    'title' => $request->title,
                ]);
                return redirect()->back()->with('success', 'دسته بندی مورد با موفقیت ذخیره شد.');
            } catch (\Exception $ex) {
                return view('errors.store_error');
            }
        }


    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function detachParent(Request $request)
    {

    }
    public function delete(Request $request)
    {

        try {
            $cat = Category::find($request->cat);
        }catch (\Exception $ex)
        {
            return view('errors.delete_error');
        }
        Category::destroy($request->cat);
        return redirect('/admin/category/index')->with('success', 'دسته بندی مورد نظر حذف شد.');
    }
}
