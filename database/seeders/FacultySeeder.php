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
                'first_name' => 'Joshua',
                'last_name' => 'Salceda',
                'middle_name' => 'C',
                'sex' => 'male',
                'email' => 'joshuasalceda0021@gmail.com',
                'contact_no' => '09123456789',
                'school_year_id' => 1,
                'department_id' => 1,
            ],
            [
                'first_name' => 'Rad Jeremy',
                'last_name' => 'Simon',
                'middle_name' => 'C',
                'sex' => 'male',
                'email' => 'rad@gmail.com',
                'contact_no' => '09123456789',
                'school_year_id' => 1,
                'department_id' => 1,
            ],

        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
