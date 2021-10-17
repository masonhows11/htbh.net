<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminCourseController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $courses = Course::orderBy('created_at','asc')->paginate(3);
        return view('admin.course_management.index')
            ->with(['courses'=>$courses,'categories'=>$categories]);
    }
    public function listCourseBaseCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:categories,name'
        ], $message = [
            'category.required' => 'یک دسته بندی انتخاب کنید.',
            'category.exists' => 'دسته بندی مورد نظر وجود ندارد.',
        ]);
        $categories = Category::all();

        try {
            $courses =
                DB::table('courses')
                    ->join('category_course', 'courses.id', '=', 'category_course.course_id')
                    ->join('categories', 'categories.id', '=', 'category_course.category_id')
                    ->select('courses.*')
                    ->where('categories.name', '=', $request->category)
                    ->orderBy('created_at','asc')->paginate(3);
           return view('admin.course_management.index')->with(['courses' => $courses, 'categories' => $categories]);
        } catch (\Exception $ex) {
             return view('errors.error_not_found_model');
        }

    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.course_management.create')
            ->with('categories', $categories);
    }

    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'title' => 'required|max:150',
            'name' => 'required|max:150',
            'description' => 'required|min:50',
            'status_paid' => ['between:1,2', 'required', 'numeric'],
            'level_course' => 'required',
            'image' => 'required',
            'category' => 'required',
            'price' => ['between:0,100000000', 'numeric', Rule::requiredIf($request->status_paid == 2)],
        ], $messages = [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.max' => 'حداکثر ۵۰ کاراکتر.',
            'name.required' => 'فیلد نام الزامی است.',
            'name.max' => 'حداکثر ۵۰ کاراکتر.',
            'description.required' => 'فیلد توضیحات الزامی است.',
            'description.min' => 'حداقل ۵۰ کاراکتر.',
            'level_course.required' => ' فیلد سطح دوره الزامی است.',
            'image.required' => 'فیلد تصویر الزامی است.',
            'cat.required' => 'دسته بندی الزامی است.',
            'status_paid.required' => 'نوع قیمت الزامی است.',
            'status_paid.between' => 'نوع پرداخت را انتخاب کنید.',
            'price.required' => 'قیمت دوره را وارد کنید.',
            'price.numeric' => 'قیمت را به عدد وارد کنید.',
            'price.between' => 'حدود قیمت باید بیشتر از ۱۰۰ تومان باشد.'
        ]);
        $image_path = null;
        if ($request->filled('image')) {
            $image = $request->image;
            $image_path = str_replace('http://localhost/', '', $image);
        }

        $course = Course::create([
            'name' => $request->name,
            'title' => $request->title,
            'user_id' => Auth::id(),
            'description' => $request->description,
            'status_paid' => $request->status_paid,
            'level_course' => $request->level_course,
            'price' => $request->price,
            'image' => $image_path,
        ]);
        $course->categories()->sync($request->category);
        return redirect('/admin/course/index')->with('success', 'دوره آموزشی با موفقیت ایجاد شد.');
    }


    public function edit(Request $request)
    {
        $course = Course::with('categories')
            ->where('id', $request->course)->first();

        $parent_categories = Category::where('parent_id', null)->get();
        return view('admin.training_course_management.edit')
            ->with(['parent_categories' => $parent_categories, 'course' => $course]);

    }

    public function update(Request $request)
    {

        $request->validate([
            'title' => 'required|max:150',
            'name' => 'required|max:150',
            'description' => 'required|min:50',
            'status_paid' => 'required|integer',
            'level_course' => 'required',
            'image' => 'required',
            'cat' => 'required',
            ''
        ], $messages = [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.max' => 'حداکثر ۵۰ کاراکتر.',
            'name.required' => 'فیلد نام الزامی است.',
            'name.max' => 'حداکثر ۵۰ کاراکتر.',
            'description.required' => 'فیلد توضیحات الزامی است.',
            'description.min' => 'حداقل ۵۰ کاراکتر.',
            'level_course.required' => ' فیلد سطح دوره الزامی است.',
            'image.required' => 'فیلد تصویر الزامی است.',
            'cat.required' => 'دسته بندی الزامی است.',
            'status_paid.required' => 'نوع قیمت الزامی است.',
        ]);

        $image_path = null;
        if ($request->has('image')) {
            $image = $request->image;
            $image_path = str_replace('http://localhost/', '', $image);
        }
        $course = Course::findOrFail($request->id);
        $course->title = $request->title;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->status_paid = $request->status_paid;
        $course->level_course = $request->level_course;
        $course->image = $image_path;
        $course->save();

        $course->categories()->sync($request->cat);

        return redirect('/admin/course/index')
            ->with('success', 'دوره آموزشی با موفقیت ویرایش شد.');
    }



    public function delete(Request $request)
    {
        $course = Course::find($request->course_id);
        if (!$course) {
            return response()->json(['warning' => 'دوره مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            Course::destroy($request->course_id);
            return response()->json(['success' => 'دوره نظر با موفقیت حذف شد.', 'status' => 200], 200);
        } catch (\Exception $ex) {
            return response()->json(['exception' => $ex->getMessage(), 'status' => 500], 500);
        }

    }


    public function detail(Request $request)
    {
        $course = Course::findOrFail($request->course);
        $lessons = Lesson::where('course_id', $request->course)
            ->select('lesson_duration')->get();

        if ($lessons->isNotEmpty()) {
            $last_update = Lesson::latest()->first();
            $last_update = date('Y:m:d', strtotime($last_update->created_at));
            $lessons_count = count($lessons);
            $seconds = null;
            for ($i = 0; $i < $lessons_count; $i++) {

                $time = $lessons[$i]['lesson_duration'];
                $seconds = $seconds + strtotime($time);
            }
            $course_time = date("H:i:s", strtotime($seconds) + $seconds);
            return view('admin.training_course_management.details')
                ->with(['course' => $course,
                    'course_time' => $course_time,
                    'lessons_count' => $lessons_count,
                    'last_update' => $last_update]);

        }

        return view('admin.training_course_management.details')
            ->with(['course' => $course]);


    }

    public function changePublishStatus(Request $request)
    {

        $course = Course::find($request->course_id);
        if (!$course) {
            return response()->json(['warning' => 'دوره مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            if ($course->status_publish == 0) {
                $course->status_publish = 1;
                $course->course_status = 1;
            } else {
                $course->status_publish = 0;
                $course->course_status = 0;
            }
            $course->save();
            $publish_status = $course->status_publish;
            return response()->json(['success' => 'وضعیت انتشار با موفقیت تغییر کرد.', 'publish' => $publish_status, 'status' => 200], 200);
        }catch (\Exception $ex)
        {
            return response()->json(['error' => 'عملیات انتشار انجام نشد.', 'status' => 500], 500);
        }

    }






}
