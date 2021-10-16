<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\lesson;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();//orderBy('id','asc')->get();
        return view('admin.training_course_management.index')
            ->with('courses', $courses);
    }

    ////////////////////////////// course section ////////////////////////////
    public function create()
    {
        $parent_categories = Category::where('parent_id', null)->get();
        return view('admin.training_course_management.create')
            ->with('parent_categories', $parent_categories);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:150',
            'name' => 'required|max:150',
            'description' => 'required|min:50',
            'status_paid' => ['between:1,2', 'required', 'numeric'],
            'level_course' => 'required',
            'image' => 'required',
            'cat' => 'required',
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
        if ($request->has('image')) {
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
        $course->categories()->sync($request->cat);
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

        $validated = $request->validate([
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
        if (Course::destroy($request->course_id)) {

            return response()->json(['success' => '.دوره مورد نظر با موفقیت حذف شد', 'status' => 200], 200);
        }
        return response()->json(['error' => '.عملیات حذف  انجام نشد', 'status' => 500], 500);

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

        $course = Course::findOrFail($request->course_id);
        if ($course->status_publish == 0) {
            $course->status_publish = 1;
            $course->course_status = 1;
        } else {
            $course->status_publish = 0;
            $course->course_status = 0;
        }

        $course->save();
        $publish_status = $course->status_publish;
        if ($course->save()) {

            return response()->json(['success' => '.وضعیت انتشار با موفقیت تغییر کرد', 'publish' => $publish_status, 'status' => 200], 200);
        }
        return response()->json(['error' => '.عملیات انتشار انجام نشد', 'status' => 500], 500);
    }


    //////////////////////// lesson section ///////////////////////////////////

    public function createNewLesson(Request $request)
    {
        $course = Course::find($request->course);
        $lessons = Lesson::where('course_id', '=', $request->course)->paginate(3);
        return view('admin.training_course_management.add_lesson')
            ->with(['course' => $course, 'lessons' => $lessons]);
    }


    public function storeNewLesson(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:100',
            'name' => 'required|max:100',
            'lesson_duration' => ['required', 'regex:/^([01]?\d|2[0-3]|24(?=:00?:00?$)):([0-5]\d):([0-5]\d)$/'],
            'video_path' => 'required'
            //'video_path' => ['required','mimetypes:video/avi,video/mp4,video/mkv']
        ], $messages = [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.max' => 'حداکثر ۱۰۰ کاراکتر.',
            'name.required' => 'فیلد نام الزامی است.',
            'name.max' => 'حداکثر ۱۰۰ کاراکتر.',
            'lesson_duration.required' => 'مدت زمان درس  را وارد کنید.',
            'lesson_duration.regex' => 'فرمت  مدت زمان را به صورت ساعت:دقیقه:ثانیه وارد کنید از چپ به راست.',
            'video_path.required' => 'لینک فایل آموزشی را وارد کنید.',
            //'video_path.required' => 'فایل ویدئو را انتخاب کنید.',
            //'video_path.mimetypes'=>'فرمت فایل ویدئو انتخابی معتبر نمی باشد.'
        ]);

        /* if ($request->file('video_path')) {
             $original_name = $request->file('video_path')->getClientOriginalName();
             $save_path = '/public/video/lessons';
             $file_name_upload = time() . '.' . $original_name;
             $file_name_store = $save_path . '.' . $file_name_upload;
             $request->file('video_path')->move('video/lessons', $file_name_upload);
         }*/


        Lesson::create([
            'course_id' => $request->id,
            'title' => $request->title,
            'name' => $request->name,
            'lesson_duration' => $request->lesson_duration,
            'video_path' => $request->video_path
            //'video_path' => $file_name_store,
        ]);

        return redirect()->back()->with('success', 'قسمت جدید با موفقیت ایجاد شد.');
    }

    public function editLesson(Request $request)
    {

        $lesson = Lesson::where('id', '=', $request->lesson)
            ->where('course_id', '=', $request->course)
            ->first();
        $course = $request->course;
        return view('admin.training_course_management.edit_lesson')
            ->with(['lesson' => $lesson, 'course' => $course]);


    }

    public function updateLesson(Request $request)
    {

        //return $request;
        $validated = $request->validate([
            'title' => 'required|max:100',
            'name' => 'required|max:100',
            'lesson_duration' => ['required', 'regex:/^([01]?\d|2[0-3]|24(?=:00?:00?$)):([0-5]\d):([0-5]\d)$/'],
            'video_path' => 'required'
            //'video_path' => ['required','mimetypes:video/avi,video/mp4,video/mkv']
        ], $messages = [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.max' => 'حداکثر ۱۰۰ کاراکتر.',
            'name.required' => 'فیلد نام الزامی است.',
            'name.max' => 'حداکثر ۱۰۰ کاراکتر.',
            'lesson_duration.required' => 'مدت زمان درس  را وارد کنید.',
            'lesson_duration.regex' => 'فرمت  مدت زمان را به صورت ساعت:دقیقه:ثانیه وارد کنید از چپ به راست.',
            'video_path.required' => 'لینک فایل آموزشی را وارد کنید.',
            //'video_path.required' => 'فایل ویدئو را انتخاب کنید.',
            //'video_path.mimetypes'=>'فرمت فایل ویدئو انتخابی معتبر نمی باشد.'
        ]);

        /* if ($request->file('video_path')) {
             $original_name = $request->file('video_path')->getClientOriginalName();
             $save_path = '/public/video/lessons';
             $file_name_upload = time() . '.' . $original_name;
             $file_name_store = $save_path . '.' . $file_name_upload;
             $request->file('video_path')->move('video/lessons', $file_name_upload);
         }*/
        //'video_path' => $file_name_store,

        Lesson::where('id', '=', $request->lesson_id)
            ->where('course_id', '=', $request->course_id)
            ->update([
                'title' => $request->title,
                'name' => $request->name,
                'lesson_duration' => $request->lesson_duration,
                'video_path' => $request->video_path]);

        return redirect()->back()->with('success', 'قسمت جدید با موفقیت ویرایش شد.');
    }

    public function deleteLesson(Request $request)
    {

        $lesson_deleted = Lesson::where('id', '=', $request->lesson_id)
            ->where('course_id', '=', $request->course_id)
            ->delete();

        if ($lesson_deleted) {
            return response()->json(['success' => '.قسمت مورد نظر با موفقیت حذف شد', 'status' => 200], 200);
        }
        return response()->json(['error' => '.عملیات حذف انجام نشد', 'status' => 500], 500);
    }

}
