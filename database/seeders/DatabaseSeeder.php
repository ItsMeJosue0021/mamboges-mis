<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\Student;
use App\Models\Updates;
use App\Models\Feedback;
use App\Models\Guardian;
use App\Models\SectionStudents;
use App\Models\SectionSubjects;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(10)->create();

        Feedback::factory(15)->create();

        Updates::factory(20)->create();

        Section::factory(25)->create();

        Faculty::factory(30)->create();

        Student::factory(300)->create();

        Guardian::factory(200)->create();

        // SectionStudents::factory(300)->create();

        // SectionSubjects::factory(150)->create();

        $this->call(UserTableSeeder::class);

        //      departments

        DB::table('departments')->insert([
            'department_name' => 'English',
            'department_head' => 6,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'Math',
            'department_head' => 5,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'Filipino',
            'department_head' => 4,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'Science',
            'department_head' => 3,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'TLE',
            'department_head' => 2,
        ]);

        DB::table('departments')->insert([
            'department_name' => 'MAPEH',
            'department_head' => 1,
        ]);

            //  subjects

        DB::table('subjects')->insert([
            'subject_name' => 'English'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Math'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Filipino'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'Science'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'TLE'
        ]);

        DB::table('subjects')->insert([
            'subject_name' => 'MAPEH'
        ]);

        // school year

        DB::table('school_years')->insert([
            'name' => '2022-2023',
            'start_date' => '2022-06-04',
            'end_date' => '2023-04-04',
            'is_current' => true,
        ]);

        DB::table('school_years')->insert([
            'name' => '2023-2024',
            'start_date' => '2022-06-04',
            'end_date' => '2023-04-04',
            'is_current' => false,
        ]);

    }
}
