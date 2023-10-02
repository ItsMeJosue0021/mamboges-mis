<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            [
                'user_id' => 6,
                'department_id' => 2,
                
            ],
            [
                'user_id' => 7,
                'department_id' => 1,
            ],

        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
