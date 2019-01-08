<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_class', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cid')->comment('课程id');
            $table->integer('tid')->comment('教师id');
            $table->integer('sid')->comment('学生id');
            $table->string('name')->nullable()->comment('学生姓名');
            $table->string('question')->nullable()->comment('解决问题');
            $table->text('content')->nullable()->comment('上课内容');
            $table->string('attention')->nullable()->comment('上课注意力');
            $table->string('other')->nullable()->comment('其他介绍');
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
        Schema::dropIfExists('appointment_class');
    }
}
