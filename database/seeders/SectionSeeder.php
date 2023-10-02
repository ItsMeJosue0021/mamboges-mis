<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'Rose',
                'gradeLevel' => 'Kinder',
            ],
            [
                'name' => 'Gumamela',
                'gradeLevel' => '1',
            ],
            [
                'name' => 'Sampaguita',
                'gradeLevel' => '2',
            ],
            [
                'name' => 'Daisy',
                'gradeLevel' => '3',
            ],
            [
                'name' => 'Sun Flower',
                'gradeLevel' => '4',
            ],
            [
                'name' => 'Tulips',
                'gradeLevel' => '5',
            ],
            [
                'name' => 'Lily',
                'gradeLevel' => '6',
            ]
        ];

        foreach ($sections as $section) {
            DB::table('sections')->insert([
                'name' => $section['name'],
                'gradeLevel' => $section['gradeLevel'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
