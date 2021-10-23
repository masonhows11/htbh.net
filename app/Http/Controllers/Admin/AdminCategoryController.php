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
            'name' => 'required|min:3',
            'title' => 'required|min:3',

        ], $message = [
            'name.required' => 'نام دسته بندی را وارد کنید',
            'name.min' => ' حداکثر ۳ کاراکتر ',
            'title.min' => ' حداکثر ۳ کاراکتر ',
            'title.required' => 'عنوان دسته بندی را وارد کنید',


        ]);
        try {

            if ($request->filled('parent')) {
                Category::create([
                    'name' => $request->name,
                    'title' => $request->title,
                    'parent_id' => $request->parent,
                ]);
                return redirect()->back()->with('success', 'دسته بندی مورد با موفقیت ذخیره شد.');
            } else {
                Category::create([
                    'name' => $request->name,
                    'title' => $request->title,
                ]);
                return redirect()->back()->with('success', 'دسته بندی مورد با موفقیت ذخیره شد.');
            }
        } catch (\Exception $ex) {
            return view('errors.error_store_model');
        }

    }

    public function edit(Request $request)
    {
        $category = Category::find($request->cat);
        $parent = Category::getParent($category->parent_id);
        $categories = Category::all();
        return view('admin.category_management.edit')
            ->with(['category' => $category, 'categories' => $categories, 'parent' => $parent]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'title' => 'required|min:3',
            'slug' => 'required|min:3',
        ], $message = [
            'name.required' => 'نام دسته بندی را وارد کنید',
            'name.min' => ' حداکثر ۳ کاراکتر ',

            'title.min' => ' حداکثر ۳ کاراکتر ',
            'title.required' => 'عنوان دسته بندی را وارد کنید',

            'slug.required' => 'اسلاگ به انگلیسی',
            'slug.max' => ' حداکثر ۳ کاراکتر '
        ]);

        try {
            $category = Category::findOrFail($request->id);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'دسته بندی مورد نظر وجود ندارد');
        }

        try {

            if ($request->filled('parent')) {
                Category::where('id', $request->id)
                    ->update(['name' => $request->name,
                        'title' => $request->title,
                        'slug' => $request->slug,
                        'parent_id' => $request->parent]);

                return redirect('/admin/category/index')->with('success', 'دسته بندی مورد با موفقیت ویرایش شد.');
            } elseif ($request->filled('old_parent')) {
                Category::where('id', $request->id)
                    ->update(['name' => $request->name,
                        'title' => $request->title,
                        'slug' => $request->slug,
                        'parent_id' => $request->old_parent]);
                return redirect('/admin/category/index')->with('success', 'دسته بندی مورد با موفقیت ویرایش شد.');
            } else
                Category::where('id', $request->id)
                    ->update(['name' => $request->name,
                        'title' => $request->title,
                        'slug' => $request->slug,
                        'parent_id' => $request->old_parent]);

            return redirect('/admin/category/index')->with('success', 'دسته بندی مورد با موفقیت ویرایش شد.');

        } catch (\Exception $ex) {
            return view('errors.error_store_model');
        }


    }

    public function detachParent(Request $request)
    {
        try {
            $category = Category::findOrFail($request->cat);
        } catch (\Exception $ex) {
            return view('errors.error_not_found_model');
        }
        $category->parent_id = null;
        $category->save();
        return redirect('/admin/category/index')->with('success', 'دسته بندی مورد نظر با موفقیت ویرایش شد.');
    }

    public function delete(Request $request)
    {

        try {
            $category = Category::findOrFail($request->cat);
        } catch (\Exception $ex) {
            return view('errors.error_not_found_model');
        }
        Category::destroy($request->cat);
        return redirect('/admin/category/index')->with('success', 'دسته بندی مورد نظر حذف شد.');
    }
}
