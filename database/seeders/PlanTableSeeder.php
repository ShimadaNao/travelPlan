<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'id' => 1,
            'user_id' => 1,
            'country_id' => 153,
            'title' => '大阪旅行',
            'start' => '2022-04-22',
            'end' => '2022-04-28',
            'public' => 'yes',
        ]);
        DB::table('plans')->insert([
            'id' => 2,
            'user_id' => 2,
            'country_id' => 5,
            'title' => 'アメリカ旅行',
            'start' => '2022-11-08',
            'end' => '2022-11-15',
            'public' => 'yes',
        ]);
        DB::table('plans')->insert([
            'id' => 3,
            'user_id' => 2,
            'country_id' => 208,
            'title' => '香港旅行',
            'start' => '2022-02-08',
            'end' => '2022-02-11',
            'public' => 'no',
        ]);
        DB::table('plans')->insert([
            'id' => 4,
            'user_id' => 1,
            'country_id' => 51,
            'title' => 'カナダ旅行',
            'start' => '2022-03-10',
            'end' => '2022-03-20',
            'public' => 'no',
        ]);
        DB::table('plans')->insert([
            'id' => 5,
            'user_id' => 1,
            'country_id' => 156,
            'title' => 'ニュージーランド旅行',
            'start' => '2022-03\1-10',
            'end' => '2022-01-23',
            'public' => 'no',
        ]);
    }
}
