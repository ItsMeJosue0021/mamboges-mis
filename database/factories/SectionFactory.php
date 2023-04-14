<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->lastName(),
            'grade_level' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '6']),
            'adviser_faculty_id' => $this->faker->unique()->numberBetween(1, 30),
            'school_year_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
