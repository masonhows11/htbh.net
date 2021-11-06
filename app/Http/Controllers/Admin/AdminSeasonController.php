<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSeasonController extends Controller
{
    //
    public function create(Request $request)
    {
        $course = Course::with('seasons')
            ->where('id','=',$request->course)->get();
    //return $course;
        return view('admin.season_management.create')
            ->with(['course'=>$course]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:20',
            'name' => 'required|max:20',
        ],$messages=[
            'title.required' => 'عنوان را به فارسی وارد کنید.',
            'title.max'=> 'حداکثر ۲۰ کاراکتر.',
            'name.required' => 'نام را به انگلیسی وارد کنید.',
            'name.max'=> 'حداکثر ۲۰ کاراکتر.',
        ]);
        try {
            Season::create([
                'title'=>$request->title,
                'name'=>$request->name,
                'course_id' => $request->course,
            ]);
            return redirect()
                ->back()
                ->with(['success'=>'فصل جدید با موفقیت ذخیره شد.']);
        }catch (\Exception $ex)
        {

            return view('errors.error_store_model');
        }

    }

    public function edit(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete(Request  $request)
    {

    }
}
