<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'locale' => 'Ukrainian',
            'prefix' => 'ua'
        ]);
        DB::table('languages')->insert([
            'locale' => 'Russian',
            'prefix' => 'ru'
        ]);
        DB::table('languages')->insert([
            'locale' => 'English',
            'prefix' => 'en'
        ]);

    }
}
