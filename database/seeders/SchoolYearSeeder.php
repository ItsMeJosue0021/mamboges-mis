<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('school_years')->insert([
            'name' => '2022-2023',
            'start_date' => '2022-06-04',
            'end_date' => '2023-04-04',
            'is_current' => true,
        ]);

        DB::table('school_years')->insert([
            'name' => '2023-2024',
            'start_date' => '2022-06-04',
            'end_date' => '2023-04-04',
            'is_current' => false,
        ]);
    }
}
