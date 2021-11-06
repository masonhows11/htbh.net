<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminSeasonController extends Controller
{
    //
    public function create(Request $request)
    {
        $course = Course::with('seasons')
            ->where('id', '=', $request->course)->get();


        session()->forget('create_season');
        Session()->regenerate();
        session()->put('create_season', $request->fullUrl());


        return view('admin.season_management.create')
            ->with(['course' => $course]);
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|max:20',
            'name' => 'required|max:20',
        ], $messages = [
            'title.required' => 'عنوان را به فارسی وارد کنید.',
            'title.max' => 'حداکثر ۲۰ کاراکتر.',
            'name.required' => 'نام را به انگلیسی وارد کنید.',
            'name.max' => 'حداکثر ۲۰ کاراکتر.',
        ]);
        try {
            Season::create([
                'title' => $request->title,
                'name' => $request->name,
                'course_id' => $request->course,
            ]);
            return redirect()
                ->back()
                ->with(['success' => 'فصل جدید با موفقیت ذخیره شد.']);
        } catch (\Exception $ex) {

            return view('errors.error_store_model');
        }

    }

    public function edit(Request $request)
    {

        try {

            $season = Season::findOrFail($request->season);
            return view('admin.season_management.edit')
                ->with(['season' => $season]);
        } catch (\Exception $ex) {
            return view('errors.error_not_found_model');
        }


    }

    public function update(Request $request)
    {

        $request->validate([
            'title' => 'required|max:20',
            'name' => 'required|max:20',
        ], $messages = [
            'title.required' => 'عنوان را به فارسی وارد کنید.',
            'title.max' => 'حداکثر ۲۰ کاراکتر.',
            'name.required' => 'نام را به انگلیسی وارد کنید.',
            'name.max' => 'حداکثر ۲۰ کاراکتر.',
        ]);

        try {
            Season::where('id', '=', $request->season)->update([
                'title' => $request->title,
                'name' => $request->name,
            ]);

            if (session()->has('create_season')) {

                return redirect()->to(session()->get('create_season'));
            }
            return redirect()->back()->with(['success' => 'فصل با موفقیت ویرایش شد.']);
        } catch (\Exception $ex) {

            return view('errors.error_store_model');
        }

    }

    public function delete(Request $request)
    {
       
        $season = Season::where('id', '=', $request->season)
            ->where('course_id', '=', $request->course)
            ->first();
        if (!$season) {
            return response()->json(['warning' => 'فصل مورد نظر وجود ندارد.', 'status' => 404], 200);
        }
        try {
            $season->delete();

            return response()->json(['success' => 'فصل مورد نظر با موفقیت حذف شد.', 'status' => 200], 200);
        } catch (\Exception $ex) {

            return response()->json(['error' => 'عملیات حذف انجام نشد.', 'status' => 500], 500);
        }

    }
}
