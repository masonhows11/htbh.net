<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    //
    public function store(Request $request)
    {
        if($request->hasFile('file') && $request->file('file')->isValid()) {

            $extension = $request->file('file')->getClientOriginalName();

            return '$extension';

        }
    }
}
