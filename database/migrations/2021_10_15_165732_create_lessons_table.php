<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('season_id')->nullable();
            $table->foreign('season_id')
                ->references('id')
                ->on('seasons')
                ->onDelete('cascade');

            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')->onDelete('cascade');

            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('buy_able')->default(0);
            $table->string('video_path')->nullable();
            $table->string('lesson_duration')->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
