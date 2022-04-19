<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquiryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiries')->insert([
            'id' => 1,
            'user_id' => 1,
            'genre_id' => 1,
            'answer_id' => 1,
            'title' => '旅行計画登録について',
            'content' => '旅行計画登録は旅行計画登録フォームからのみ追加可能なのでしょうか？',
        ]);
        DB::table('inquiries')->insert([
            'id' => 2,
            'user_id' => 2,
            'genre_id' => 2,
            'answer_id' => null,
            'title' => '会員登録について',
            'content' => '会員登録には料金がかかりますか？',
        ]);
    }
}
