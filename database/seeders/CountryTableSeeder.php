<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'id' => 1,
            'name' => '日本',
        ]);
        DB::table('countries')->insert([
            'id' => 2,
            'name' => 'アメリカ',
        ]);
        DB::table('countries')->insert([
            'id' => 3,
            'name' => '中国',
        ]);
        DB::table('countries')->insert([
            'id' => 4,
            'name' => 'イタリア',
        ]);
    }
}
