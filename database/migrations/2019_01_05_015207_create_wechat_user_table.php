<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->string('openId')->unique()->comment('微信id');
            $table->string('nickname')->comment('微信名称');
            $table->string('avatar')->unique()->comment('微信头像');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('grade')->comment('年级');
            $table->tinyInteger('type')->default(1)->comment('身份 1 学生  2 辅导员');
            $table->string('headimg')->nullable()->comment('头像');
            $table->json('course')->nullable()->comment('课程');
            $table->string('time')->nullable()->comment('补课时间');
            $table->text('introduce')->nullable()->comment('介绍');
            $table->text('que_one')->nullable()->comment('问题1');
            $table->text('que_tew')->nullable()->comment('问题2');
            $table->tinyInteger('teach_way')->nullable()->comment('辅导方式 1 内部 2 外部 3 全都可以');
            $table->tinyInteger('is_active')->default(0)->comment('辅导员是否激活 0 学员不需要 1 不通过  2 通过');
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
        Schema::dropIfExists('wechat_user');
    }
}
