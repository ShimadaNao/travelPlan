<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planDetails')->insert([
            'id' => '1',
            'plan_id' => '1',
            'name' => 'ユニバーサルスタジオジャパン',
            'latitude' => '34.66569451363396',
            'longitude' => '135.43241500854495',
            'dayToVisit' => '2022-04-22',
            'timeToVisit' => '09:00:00',
            'comment' => 'スヌーピーと写真を撮る',
        ]);
        DB::table('planDetails')->insert([
            'id' => 2,
            'plan_id' => '6',
            'name' => 'ミラノ大聖堂',
            'latitude' => '45.46415722165656',
            'longitude' => '9.191651344299318',
            'dayToVisit' => '2022-12-09',
            'timeToVisit' => '15:00:00',
            'comment' => 'ゆっくりと観光したい',
        ]);
    }
}
