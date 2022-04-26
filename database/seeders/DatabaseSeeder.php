<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;'); mysql
        DB::statement('SET CONSTRAINTS ALL DEFERRED;'); //postgres

        DB::table('users')->truncate();
        DB::table('plans')->truncate();
        DB::table('planDetails')->truncate();
        DB::table('inquiries')->truncate();
        DB::table('inquiryGenres')->truncate();
        DB::table('inquiryAnswers')->truncate();
        $this->call([
            UserTableSeeder::class,
            AdminTableSeeder::class,
            PlanTableSeeder::class,
            PlanDetailTableSeeder::class,
            InquiryGenreTableSeeder::class,
            InquiryTableSeeder::class,
            InquiryAnswerTableSeeder::class,
        ]);

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE;');

        // $this->call([
        //     AdminTableSeeder::class,
        // ]);
    }
}
