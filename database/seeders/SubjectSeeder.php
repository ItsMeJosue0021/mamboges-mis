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
        $subjects = [
            [
                'name' => 'English',
                'department_id' => 1,
            ],
            [
                'name' => 'Math',
                'department_id' => 2,
            ],
            [
                'name' => 'Filipino',
                'department_id' => 3,
            ],
            [
                'name' => 'Science',
                'department_id' => 4,
            ],
            [
                'name' => 'TLE',
                'department_id' => 5,
            ],
            [
                'name' => 'MAPEH',
                'department_id' => 6,
            ],
        ];

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert([
                'name' => $subject['name'],
                'department_id' => $subject['department_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }  
    }
}
