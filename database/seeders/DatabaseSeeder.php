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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('plans')->truncate();
        DB::table('planDetails')->truncate();
        DB::table('inquiryGenres')->truncate();
        $this->call([
            UserTableSeeder::class,
            AdminTableSeeder::class,
            PlanTableSeeder::class,
            PlanDetailTableSeeder::class,
            InquiryGenreTableSeeder::class,
            InquiryTabelSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // $this->call([
        //     AdminTableSeeder::class,
        // ]);
    }
}
