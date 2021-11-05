<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSeasonController extends Controller
{
    //
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course);

        return view('admin.season_management.create')
            ->with(['course'=>$course]);
    }

    public function store(Request $request)
    {
        //return $request;

        
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
