<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAndTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_and_teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cid')->comment('课程id');
            $table->integer('uid')->comment('教师id');
            $table->tinyInteger('status')->default(1)->comment('状态 1 显示 2 显示');
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
        Schema::dropIfExists('course_and_teachers');
    }
}
