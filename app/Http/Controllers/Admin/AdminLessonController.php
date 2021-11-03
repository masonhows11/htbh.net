<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\lesson;
use App\services\UpdateCourseDetail;
use Illuminate\Http\Request;



class AdminLessonController extends Controller
{
    public function createNewLesson(Request $request)
    {
        $course = Course::find($request->course);
        $lessons = Lesson::where('course_id', '=', $request->course)
            ->orderBy('created_at', 'asc')->get();

        session()->put('current_lesson', $request->fullUrl());

        return view('admin.lesson_management.create')
            ->with(['course' => $course, 'lessons' => $lessons]);
    }


    public function storeNewLesson(Request $request)
    {

        
        $request->validate([
            'title' => 'required|max:50',
            'name' => 'required|max:50',
            'lesson_duration' => ['required', 'regex:/^([01]?\d|2[0-3]|24(?=:00?:00?$)):([0-5]\d):([0-5]\d)$/'],
            'video_path' => 'required',
            'buy_able'=>'required',
        ], $messages = [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.max' => 'حداکثر ۵۰ کاراکتر.',
            'name.required' => 'فیلد نام الزامی است.',
            'name.max' => 'حداکثر ۵۰ کاراکتر.',
            'lesson_duration.required' => 'مدت زمان درس  را وارد کنید.',
            'lesson_duration.regex' => 'فرمت  مدت زمان را به صورت ساعت:دقیقه:ثانیه وارد کنید از چپ به راست.',
            'video_path.required' => 'لینک فایل آموزشی را وارد کنید.',
            'buy_able.required' => 'نوع پرداخت را انتخاب کنید.',
        ]);

        try {
            Lesson::create([
                'course_id' => $request->id,
                'title' => $request->title,
                'name' => $request->name,
                'lesson_duration' => $request->lesson_duration,
                'video_path' => $request->video_path,
                'buy_able' => $request->buy_able,
            ]);


            $detail = UpdateCourseDetail::update($request->id);


            return redirect()->back()->with('success', 'قسمت جدید با موفقیت ایجاد شد.');

        } catch (\Exception $ex) {
            return view('errors.error_store_model');
        }

    }

    public function editLesson(Request $request)
    {

        $lesson = Lesson::where('id', '=', $request->lesson)
            ->where('course_id', '=', $request->course)
            ->first();

        return view('admin.lesson_management.edit')
            ->with(['lesson' => $lesson, 'course_id' => $request->course]);


    }

    public function updateLesson(Request $request)
    {

        $request->validate([
            'title' => 'required|max:100',
            'name' => 'required|max:100',
            'lesson_duration' => ['required', 'regex:/^([01]?\d|2[0-3]|24(?=:00?:00?$)):([0-5]\d):([0-5]\d)$/'],
            'video_path' => 'required'

        ], $messages = [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.max' => 'حداکثر ۱۰۰ کاراکتر.',
            'name.required' => 'فیلد نام الزامی است.',
            'name.max' => 'حداکثر ۱۰۰ کاراکتر.',
            'lesson_duration.required' => 'مدت زمان درس  را وارد کنید.',
            'lesson_duration.regex' => 'فرمت  مدت زمان را به صورت ساعت:دقیقه:ثانیه وارد کنید از چپ به راست.',
            'video_path.required' => 'لینک فایل آموزشی را وارد کنید.',

        ]);
        try {
            Lesson::where('id', '=', $request->lesson_id)
                ->where('course_id', '=', $request->course_id)
                ->update([
                    'title' => $request->title,
                    'name' => $request->name,
                    'lesson_duration' => $request->lesson_duration,
                    'video_path' => $request->video_path]);


            UpdateCourseDetail::update($request->course_id);

            if (session()->has('current_lesson')) {
                return redirect()->to(session('current_lesson'))->with('success', 'قسمت جدید با موفقیت ویرایش شد.');
            }

            return redirect()->back()->with('success', 'قسمت جدید با موفقیت ویرایش شد.');
        } catch (\Exception $ex) {
            return view('errors.error_store_model');
        }

    }

    public function deleteLesson(Request $request)
    {


        $lesson = Lesson::where('id', '=', $request->lesson_id)
            ->where('course_id', '=', $request->course_id)->first();

        if (!$lesson) {
            return response()->json(['warning' => 'درس مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            $lesson->delete();


            UpdateCourseDetail::update($request->course_id);

            return response()->json(['success' => 'درس مورد نظر با موفقیت حذف شد.', 'status' => 200], 200);
        } catch (\Exception $ex) {

        return response()->json(['error' => 'عملیات حذف انجام نشد.', 'status' => 500], 500);
        }
    }
}
