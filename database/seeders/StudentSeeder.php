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
        ];

        foreach($students as $student) {
            Student::create($student);
        }
    }
}
