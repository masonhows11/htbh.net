<?php


namespace App\services;


use App\Models\Course;
use App\Models\lesson;
use App\services\calculate_course_time;

class UpdateCourseDetail
{
    public static function update($lessons_duration, $course_id): array
    {
        $final_time = null;
        $lessons_count = null;
        $time_array = [];

        $course = Course::findOrFail($course_id);

        foreach ($lessons_duration as $item) {
            $time_array[] = date('H:i:s', strtotime($item->lesson_duration));
        }
        $last_update_store = Lesson::where('course_id', $course_id)->latest()->first();

        $last_update_sh = date('Y:m:d', strtotime($last_update_store->created_at));
        $lessons_count = count($lessons_duration);
        $final_time = calculate_course_time::CalculateTime($time_array);

        $course->course_duration = $final_time;
        $course->video_count = $lessons_count;
        // $course->last_update = $last_update_store;
        $course->Save();

        return array($last_update_sh,$final_time,$lessons_count);
    }

}
