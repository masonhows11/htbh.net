<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CourseUser extends Model
{
    use HasFactory;

    protected $table = 'course_user';
    protected $fillable = ['course_id','user_id'];

    public static function checkAddOrNot($user,$course)
    {
        $added = DB::table('course_user')
            ->where('user_id', '=', $user)
            ->where('course_id','=',$course)
            ->count();
        if ($added > 0 ) {
            return true;
        }
        return false;
    }


}
