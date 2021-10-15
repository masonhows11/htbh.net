<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->string('slug');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->text('description');
            $table->string('image');
            $table->unsignedBigInteger('student_count')->default(0);
            $table->unsignedBigInteger('video_count')->default(0);
            $table->time('course_duration')->default(0);
            $table->string('price')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->string('level_course')->nullable();
            $table->string('status_paid')->nullable();
            $table->tinyInteger('status_publish')->default(0);
            $table->tinyInteger('course_status')->default(0);
            $table->double('discount')->default(0);
            $table->timestamp('last_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
