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
            'country_id' => 1,
            'city' => '大阪',
            'latitude' => '34.6778',
            'longitude' => '135.4546',
            'from' => '2022-04-22',
            'to' => '2022-04-28',
        ]);
        DB::table('plans')->insert([
            'id' => 2,
            'user_id' => 2,
            'country_id' => 2,
            'city' => 'ロサンゼルス',
            'latitude' => '33.9991',
            'longitude' => '118.4117',
            'from' => '2022-11-08',
            'to' => '2022-11-15',
        ]);
    }
}
