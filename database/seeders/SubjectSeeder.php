<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            'subject_name' => 'English'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Math'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Filipino'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Science'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'TLE'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'MAPEH'
        ]);
    }
}
