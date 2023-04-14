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
        DB::table('users')->insert(
            [
                'name' => 'joshua salceda',
                'email' => 'guidance@email.com',
                'username' => 'guidance@email.com',
                'password' => Hash::make('123'),
                'type' => 'guidance',
                'status' => 'active',
                'created_at' => now()
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'jsoe rizal',
                'email' => 'jose@email.com',
                'username' => 'jose@email.com',
                'password' => Hash::make('123'),
                'type' => 'faculty',
                'status' => 'active',
                'created_at' => now()
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'maria mercedes',
                'email' => 'lr@email.com',
                'username' => 'lr@email.com',
                'password' => Hash::make('123'),
                'type' => 'lr',
                'status' => 'active',
                'created_at' => now()
            ],

            [
                'name' => 'mark villar',
                'email' => 'mark@email.com',
                'username' => '249186700789',
                'password' => Hash::make('123'),
                'type' => 'student',
                'status' => 'active',
                'created_at' => now()
            ],

        );

        DB::table('users')->insert(
            [
                'name' => 'mark villar',
                'email' => 'mark@email.com',
                'username' => '249186700789',
                'password' => Hash::make('123'),
                'type' => 'student',
                'status' => 'active',
                'created_at' => now()
            ]

        );
    }
}
