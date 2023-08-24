<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('evaluation_criterias')->insert(
            [
                'name' => 'Written Works',
            ]
        );

        DB::table('evaluation_criterias')->insert(
            [
                'name' => 'Performance Tasks',
            ]
        );

        DB::table('evaluation_criterias')->insert(
            [
                'name' => 'Quarterly Assessments',
            ]
        );
    }
}
