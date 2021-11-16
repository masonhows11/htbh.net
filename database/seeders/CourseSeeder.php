<?php

namespace Database\Seeders;


use App\Models\Course;
use App\Models\Lesson;
use App\Models\Season;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::find(1);



        /************* Course php beginner start ***************/

        $course1 = Course::create([
            'title' => 'پی اچ پی مقدماتی',
            'name' => 'php beginner',
            'user_id' => $user->id,
            'level_course' => 1,
            'status_paid' => 1,
            'status_publish' => 0,
            'course_status' => 0,
            'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                 روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'image' => 'php-beginner.jpg',

        ]);

        $course1->categories()->attach(2);


        $course1->seasons()->saveMany([
            $season1 = new Season(['title' => 'فصل اول', 'name' => 'season one']),

           $season2 = new Season(['title' => 'فصل دوم', 'name' => 'season two']),
           $season3 = new Season(['title' => 'فصل سوم', 'name' => 'season three']),
        ]);

        $season1->lessons()->saveMany([
           new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
               'buy_able' => 0,
               'course_id'=> $course1->id,
               'video_path' => 'https://www.w3schools.com/',
               'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
                'buy_able' => 0,
                'course_id'=> $course1->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
                'buy_able' => 0,
                'course_id'=> $course1->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
        ]);
        $season2->lessons()->saveMany([
            new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
                'buy_able' => 0,
                'course_id'=> $course1->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
                'buy_able' => 0,
                'course_id'=> $course1->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
                'buy_able' => 0,
                'course_id'=> $course1->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
        ]);
        $season3->lessons()->saveMany([
            new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
                'buy_able' => 0,
                'course_id'=> $course1->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
                'buy_able' => 0,
                'course_id'=> $course1->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی مقدماتی', 'name' => 'php beginner',
                'buy_able' => 0,
                'course_id'=> $course1->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
        ]);

        /************* Course php beginner end ***************/




        /************* Course php advanced start ***************/

        $course2 = Course::create([
            'title' => 'پی اچ پی پیشرفته',
            'name' => 'php advanced',
            'user_id' => $user->id,
            'level_course' => 3,
            'status_paid' => 2,
            'status_publish' => 0,
            'course_status' => 0,
            'price' => '500000',
            'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                 روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'image' => 'php-advanced.jpg',

        ]);

        $course2->seasons()->saveMany([
          $season1 =  new Season(['title' => 'فصل اول', 'name' => 'season one']),
          $season2 =  new Season(['title' => 'فصل دوم', 'name' => 'season two']),
          $season3 =  new Season(['title' => 'فصل سوم', 'name' => 'season three']),
        ]);


        $course2->categories()->attach(2);

        $season1->lessons()->saveMany([
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 0,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 1,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 1,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
        ]);
        $season2->lessons()->saveMany([
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 1,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 1,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 1,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
        ]);
        $season3->lessons()->saveMany([
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 1,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 1,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
            new Lesson(['title' => 'پی اچ پی پیشرفته', 'name' => 'php advanced',
                'buy_able' => 1,
                'course_id'=> $course2->id,
                'video_path' => 'https://www.w3schools.com/',
                'lesson_duration' => '00:10:00']),
        ]);

        /************* Course php advanced end ***************/


        $course3 = Course::create([
            'title' => 'لارال مقدماتی',
            'name' => 'laravel beginner',
            'user_id' => $user->id,
            'level_course' => 1,
            'status_paid' => 1,
            'status_publish' => 0,
            'course_status' => 0,
            'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                 روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'image' => 'laravel-beginner.png',

        ]);

        $course3->categories()->attach(2);



        $course4 = Course::create([
            'title' => 'لاراول پیشرفته',
            'name' => 'laravel advanced',
            'user_id' => $user->id,
            'level_course' => 3,
            'status_paid' => 2,
            'status_publish' => 0,
            'course_status' => 0,
            'price' => '450000',
            'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه
                 روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ',
            'image' => 'laravel-advanced.png',

        ]);

        $course4->categories()->attach(2);

    }
}
