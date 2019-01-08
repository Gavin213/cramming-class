<?php

use Illuminate\Database\Seeder;

class CmsuserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cmsuser')->insert([
            'name' => 'GZH',
            'email' => 'admin@qq.com',
            'phone' => '18888888888',
            'status' => '2',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);
    }
}
