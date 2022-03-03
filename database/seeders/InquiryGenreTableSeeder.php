<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquiryGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('inquiryGenres')->truncate();
        DB::table('inquiryGenres')->insert([
            'id' => 1,
            'about' => '操作について',
        ]);
        DB::table('inquiryGenres')->insert([
            'id' => 2,
            'about' => '会員登録について',
        ]);
        DB::table('inquiryGenres')->insert([
            'id' => 3,
            'about' => 'その他',
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
