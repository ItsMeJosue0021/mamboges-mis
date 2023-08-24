<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SectionSubjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'section_id' => $this->faker->numberBetween(1, 25),
            'subject_id' => $this->faker->numberBetween(1, 6),
            'faculty_id' => $this->faker->numberBetween(1, 30),
            'school_year_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
