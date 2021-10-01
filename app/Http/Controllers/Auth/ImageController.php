<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    //
    public function store(Request $request)
    {
        $dest = 'images/users';
        $file = $request->file('avatar');
        $image_name_save =  'UIMG'.date('YmdHis') . uniqid('', true) . '.jpg';
        $move = $file->move(public_path($dest),$image_name_save);

        if (!$move) {
            return response()->json(['status' => 500, 'message' => 'ذخیره سازی عکس موفقیت آمیز نبود.']);
        }
        $userInfo = User::where('id', Auth::id())->first();
        $userPhoto = $userInfo->avatar;
        if ($userPhoto != '') {
            unlink($dest . $userPhoto);
        }
        User::where('id', Auth::id())->update(['avatar' => $image_name_save]);

        return response()->json(['status' => 200, 'message' => 'ذخیره سازی عکس با موفقیت انجام شد.', 'name' => $image_name_save]);
    }
}
