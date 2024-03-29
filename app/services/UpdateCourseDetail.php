<?php


namespace App\services;


use App\Models\Course;
use App\Models\lesson;
use App\services\CalculateCourseTime;


class UpdateCourseDetail
{
    public static function update($course_id): array
    {

        $time_array = [];

        $course = Course::findOrFail($course_id);
        $lessons_duration = Lesson::where('course_id', $course_id)->select('lesson_duration')->get();

        $last_update_sh = null;
        $final_time = null;
        $lessons_count = null;

        if (count($lessons_duration) != 0) {

            foreach ($lessons_duration as $item) {
                $time_array[] = date('H:i:s', strtotime($item->lesson_duration));
            }

            $last_update = Lesson::where('course_id', $course_id)->latest()->first();

            $last_update_sh = date('Y:m:d', strtotime($last_update->created_at));
            $lessons_count = count($lessons_duration);
            $final_time = calculateCourseTime::CalculateTime($time_array);

            $course->course_duration = $final_time;
            $course->video_count = $lessons_count;
            $course->last_update = $last_update->created_at;
            $course->Save();

        } else {
            $course->course_duration = 0;
            $course->video_count = 0;
            $course->last_update = null;
            $course->Save();
        }



        return array("last_update_sh" => $last_update_sh,
            "final_time" => $final_time,
            "lessons_count" => $lessons_count);
    }

}
