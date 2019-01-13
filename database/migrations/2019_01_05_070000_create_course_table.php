<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->comment('课程日期');
            $table->time('start')->comment('课程开始时间');
            $table->time('end')->comment('课程结束时间');
            $table->string('address')->comment('补课地址');
            $table->text('content')->nullable()->comment('本次课程全部内容');
            $table->string('behavior')->nullable()->comment('本次课程学员表现');
            $table->string('job')->nullable()->comment('课后作业');
            $table->string('last_time_job')->nullable()->comment('上次作业完成情况');
            $table->json('img')->nullable()->comment('课程图片');
            $table->tinyInteger('status')->default(1)->comment('发布课程结束总结 1 保存  2 发布');
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
        Schema::dropIfExists('course');
    }
}
