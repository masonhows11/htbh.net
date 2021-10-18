<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\lesson;
use Illuminate\Http\Request;

class AdminLessonController extends Controller
{
    public function createNewLesson(Request $request)
    {
        $course = Course::find($request->course);
        $lessons = Lesson::where('course_id', '=', $request->course)->paginate(3);
        return view('admin.lesson_management.create')
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
