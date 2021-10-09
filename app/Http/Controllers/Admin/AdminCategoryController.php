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
            ->with(['categories'=>$categories,'parent_categories'=>$parent_categories]);
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|unique:categories|max:100',
            'title' => 'required|unique:categories|max:100',

        ], $message = [
            'name.required' => 'نام دسته بندی را وارد کنید',
            'name.unique' => 'این نام تکراری است',
            'name.max' => ' حداکثر ۳۰ کاراکتر ',
            'title.required' => 'نام دسته بندی را وارد کنید',
            'title.unique' => 'این نام تکراری است',
            'title.max' => ' حداکثر ۳۰ کاراکتر '
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

            }
        }
        
            Category::create([
                'name' => $request->name,
                'title' => $request->title,
            ]);
        return redirect()->back()->with('success', 'دسته بندی مورد با موفقیت ذخیره شد.');
    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}
