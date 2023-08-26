<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            'department_name' => 'English',
            'department_head' => 6,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'Math',
            'department_head' => 5,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'Filipino',
            'department_head' => 4,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'Science',
            'department_head' => 3,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'TLE',
            'department_head' => 2,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'MAPEH',
            'department_head' => 1,
        ]);
    }
}
