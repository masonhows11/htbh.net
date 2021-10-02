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
        $dest = 'images/users/';
        $file = $request->file('avatar');
        $image_name_save = 'UIMG' . date('YmdHis') . uniqid('', true) . '.jpg';
        /// upload file to server
        $move = $file->move(public_path($dest), $image_name_save);

        if (!$move) {
            return response()->json(['status' => 0, 'msg' => 'ذخیره سازی عکس موفقیت آمیز نبود.']);

        } else {
            // delete old image if exists
            $user = User::find(Auth::id());
            $user_avatar = $user->avatar;
            if ($user_avatar != null) {
                unlink($dest.$user_avatar);
            }
            User::where('id', Auth::id())->update(['avatar' => $image_name_save]);
            return response()->json(['status' => 1, 'msg' => 'ذخیره سازی عکس با موفقیت انجام شد.', 'name' => $image_name_save]);
        }

    }
}
