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
                'name' => 'Joshua Salceda',
                'email' => 'guidance1@email.com',
                'username' => 'guidance1@email.com',
                'password' => 'josh',
                'type' => 'guidance',
                'status' => 'active',
            ],
            [
                'name' => 'Abigael Albaniel',
                'email' => 'guidance2@email.com',
                'username' => 'guidance2@email.com',
                'password' => 'abi',
                'type' => 'guidance',
                'status' => 'active',
            ],
            [
                'name' => 'Maria Mercedes',
                'email' => 'lr@email.com',
                'username' => 'lr@email.com',
                'password' => '123',
                'type' => 'lr',
                'status' => 'active',
            ],
            [
                'name' => 'mark villar',
                'email' => 'mark@email.com',
                'username' => '249186700789',
                'password' => '123',
                'type' => 'student',
                'status' => 'active',
            ],
            [
                'name' => 'joshua C. Salceda',
                'email' => 'joshuasalceda0021@gmail.com',
                'username' => 'joshuasalceda0021@gmail.com',
                'password' => 'Salceda',
                'type' => 'faculty',
                'status' => 'active',
            ],
            [
                'name' => 'Rad Jeremy S. Simon',
                'email' => 'rad@gmail.com',
                'username' => 'rad@gmail.com',
                'password' => 'Simon',
                'type' => 'faculty',
                'status' => 'active',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'type' => $user['type'],
                'status' => $user['status'],
                'created_at' => now(),
            ]);
        }
    }
}
