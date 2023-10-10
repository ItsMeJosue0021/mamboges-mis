<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            'tag' => 'news',
        ]);

        DB::table('tags')->insert([
            'tag' => 'hiring',
        ]);

        DB::table('tags')->insert([
            'tag' => 'announcement',
        ]);
    }
}
