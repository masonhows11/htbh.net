<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CourseUser extends Model
{
    use HasFactory;

    protected $table = 'course_user';
    protected $fillable = ['lesson_id','course_id','user_id','Bought'];

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

    public static function checkAccessLesson($lesson,$user)
    {

        $checkLesson = Lesson::where('id',$lesson)
            ->where('buy_able','=',0)
            ->first();

        if($checkLesson){
            return true;
        }


        $checkLesson = DB::table('course_user')
            ->join('lessons','course_user.lesson_id','=','lessons.id')
            ->where('course_user.lesson_id','=',$lesson)
            ->where('course_user.user_id',$user)
            ->where('lessons.buy_able','=',1)
            ->select('course_user.*')->get();

        if(count($checkLesson) > 0 ) {
            return true;
        }


    }



}
