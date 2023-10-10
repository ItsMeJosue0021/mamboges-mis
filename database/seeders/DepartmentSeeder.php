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
        $departments = [
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
                'name' => 'TLE'
            ],
            [
                'name' => 'MAPEH'
            ],  
        ];

        foreach ($departments as $department) {
            DB::table('departments')->insert([
                'name' => $department['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
