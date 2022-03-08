<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquiryAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiryAnswers')->truncate();
        DB::table('inquiryAnswers')->insert([
            'id' => 1,
            'inquiry_id' => 1,
            'answerer_id' => 1,
            'content' => 'トップページからも旅行計画を登録することができます。',
        ]);
    }
}
