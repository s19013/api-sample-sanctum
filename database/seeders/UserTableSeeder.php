<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ダミーデータ
        DB::table('users')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test',
                'password' => bcrypt('test'),
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test',
                'password' => bcrypt('test'),
            ],
        ]);
    }
}
