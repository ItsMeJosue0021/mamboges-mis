<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'guidance1@email.com',
                'username' => 'guidance1@email.com',
                'password' => '123',
                'type' => 'guidance',
            ],
            [
                'email' => 'guidance2@email.com',
                'username' => 'guidance2@email.com',
                'password' => '123',
                'type' => 'guidance',
            ],
            [
                'email' => 'lr@email.com',
                'username' => 'lr@email.com',
                'password' => '123',
                'type' => 'lr',
            ],
            [
                'email' => 'stud1@email.com',
                'username' => '247186700789',
                'password' => '123',
                'type' => 'student',
            ],
            [
                'email' => 'stud2@email.com',
                'username' => '249186700789',
                'password' => '123',
                'type' => 'student',
            ],
            [
                'email' => 'joshuasalceda0021@gmail.com',
                'username' => 'joshuasalceda0021@gmail.com',
                'password' => 'Salceda',
                'type' => 'faculty',
            ],
            [
                'email' => 'rad@gmail.com',
                'username' => 'rad@gmail.com',
                'password' => 'Simon',
                'type' => 'faculty',
            ],
            [
                'email' => 'emma.clark@example.com',
                'username' => '100000000001',
                'password' => 'Password1',
                'type' => 'student',
            ],
            [
                'email' => 'william.moore@example.com',
                'username' => '100000000002',
                'password' => 'Password2',
                'type' => 'student',
            ],
            [
                'email' => 'olivia.wilson@example.com',
                'username' => '100000000003',
                'password' => 'Password3',
                'type' => 'student',
            ],
            [
                'email' => 'liam.taylor@example.com',
                'username' => '100000000004',
                'password' => 'Password4',
                'type' => 'student',
            ],
            [
                'email' => 'ava.johnson@example.com',
                'username' => '100000000005',
                'password' => 'Password5',
                'type' => 'student',
            ],
            [
                'email' => 'ethan.davis@example.com',
                'username' => '100000000006',
                'password' => 'Password6',
                'type' => 'student',
            ],
            [
                'email' => 'sophia.brown@example.com',
                'username' => '100000000007',
                'password' => 'Password7',
                'type' => 'student',
            ],
            [
                'email' => 'mason.smith@example.com',
                'username' => '100000000008',
                'password' => 'Password8',
                'type' => 'student',
            ],
            [
                'email' => 'isabella.wilson@example.com',
                'username' => '100000000009',
                'password' => 'Password9',
                'type' => 'student',
            ],
            [
                'email' => 'noah.turner@example.com',
                'username' => '100000000010',
                'password' => 'Password10',
                'type' => 'student',
            ],
            [
                'email' => 'john.doe@example.com',
                'username' => 'john.doe@example.com',
                'password' => 'Password11',
                'type' => 'student',
            ],
            [
                'email' => 'alice.smith@example.com',
                'username' => 'alice.smith@example.com',
                'password' => 'Password12',
                'type' => 'student',
            ],
            [
                'email' => 'charlie.miller@example.com',
                'username' => 'charlie.miller@example.com',
                'password' => 'Password13',
                'type' => 'student',
            ],
            [
                'email' => 'linda.davis@example.com',
                'username' => 'linda.davis@example.com',
                'password' => 'Password14',
                'type' => 'student',
            ],
            [
                'email' => 'peter.wilson@example.com',
                'username' => 'peter.wilson@example.com',
                'password' => 'Password15',
                'type' => 'student',
            ],
            [
                'email' => 'megan.brown@example.com',
                'username' => 'megan.brown@example.com',
                'password' => 'Password16',
                'type' => 'student',
            ],
            [
                'email' => 'robert.clark@example.com',
                'username' => 'robert.clark@example.com',
                'password' => 'Password17',
                'type' => 'student',
            ],
            [
                'email' => 'sophie.moore@example.com',
                'username' => 'sophie.moore@example.com',
                'password' => 'Password18',
                'type' => 'student',
            ],
            [
                'email' => 'daniel.salceda@example.com',
                'username' => 'daniel.salceda@example.com',
                'password' => 'Password19',
                'type' => 'student',
            ],
            [
                'email' => 'ella.taylor@example.com',
                'username' => 'ella.taylor@example.com',
                'password' => 'Password20',
                'type' => 'student',
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'email' => $user['email'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'type' => $user['type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
