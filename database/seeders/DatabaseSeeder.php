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
use Illuminate\Database\Seeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\SchoolYearSeeder;
use Database\Seeders\EvaluationCriteriaSeeder;

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

        Student::factory(30)->create();

        Guardian::factory(200)->create();

        $this->call(UserTableSeeder::class);

        $this->call(DepartmentSeeder::class);

        $this->call(SubjectSeeder::class);

        $this->call(SchoolYearSeeder::class);

        $this->call(EvaluationCriteriaSeeder::class);

    }
}
