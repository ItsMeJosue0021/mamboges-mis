<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quarters = [
            [
                "name" => "First Quarter"
            ],
            [
                "name" => "Second Quarter"
            ],
            [
                "name" => "Third Quarter"
            ],
            [
                "name" => "Fourth Quarter"
            ]
        ];
        
        foreach ($quarters as $quarter) {
            DB::table('quarters')->insert($quarter);
        }
    }
}
