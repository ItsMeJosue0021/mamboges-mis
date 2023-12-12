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
                'name' => 'English'
            ],
            [
                'name' => 'Math'
            ],
            [
                'name' => 'Filipino'
            ],
            [
                'name' => 'Science'
            ],
            [
                'name' => 'EPP'
            ],
            [
                'name' => 'ESP'
            ],
            [
                'name' => 'Araling Panlipunan'
            ],
            [
                'name' => 'Music - MAPEH'
            ],
            [
                'name' => 'Art - MAPEH'
            ],
            [
                'name' => 'Health - MAPEH'
            ],
            [
                'name' => 'PE - MAPEH'
            ],

        ];

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert([
                'name' => $subject['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
