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
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\AddressSeeder;
use Database\Seeders\FacultySeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\QuarterSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\UpdatesSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\SchoolYearSeeder;
use Database\Seeders\UpdateImageSeeder;
use Database\Seeders\EvaluationCriteriaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UserTableSeeder::class);
        $this->call(SchoolYearSeeder::class);

        $this->call(ProfileSeeder::class);
        $this->call(AddressSeeder::class);

        $this->call(EvaluationCriteriaSeeder::class);

        $this->call(QuarterSeeder::class);

        $this->call(TagSeeder::class);

        $this->call(UpdatesSeeder::class);

        $this->call(UpdateImageSeeder::class);

        $this->call(DepartmentSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(SectionSeeder::class);
        // $this->call(StudentSeeder::class);

    }
}
