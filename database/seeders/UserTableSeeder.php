<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'tedy',
            'email' => 'tedy@gmail.com',
            'password' => Hash::make('tedy123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'coco',
            'email' => 'coco@gmail.com',
            'password' => Hash::make('coco123456'),
        ]);
    }
}
