<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'lrn' => '247186700789',
                'user_id' => 4,
            ],
            [
                'lrn' => '249186700789',
                'user_id' => 5,
            ],
            [
                'lrn' => '100000000001',
                'user_id' => 8,
            ],
            [
                'lrn' => '100000000002',
                'user_id' => 9,
            ],
            [
                'lrn' => '100000000003',
                'user_id' => 10,
            ],
            [
                'lrn' => '100000000004',
                'user_id' => 11,
            ],
            [
                'lrn' => '100000000005',
                'user_id' => 12,
            ],
            [
                'lrn' => '100000000006',
                'user_id' => 13,
            ],
            [
                'lrn' => '100000000007',
                'user_id' => 14,
            ],
            [
                'lrn' => '100000000008',
                'user_id' => 15,
            ],
            [
                'lrn' => '100000000009',
                'user_id' => 16,
            ],
            [
                'lrn' => '100000000010',
                'user_id' => 17,
            ],
            // Additional entries
            [
                'lrn' => '100000000011',
                'user_id' => 18,
            ],
            [
                'lrn' => '100000000012',
                'user_id' => 19,
            ],
            [
                'lrn' => '100000000013',
                'user_id' => 20,
            ],
            [
                'lrn' => '100000000014',
                'user_id' => 21,
            ],
            [
                'lrn' => '100000000015',
                'user_id' => 22,
            ],
            [
                'lrn' => '100000000016',
                'user_id' => 23,
            ],
            [
                'lrn' => '100000000017',
                'user_id' => 24,
            ],
            [
                'lrn' => '100000000018',
                'user_id' => 25,
            ],
            [
                'lrn' => '100000000019',
                'user_id' => 26,
            ],
            [
                'lrn' => '100000000020',
                'user_id' => 27,
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }

}
