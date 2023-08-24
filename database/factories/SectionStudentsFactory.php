<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SectionStudentsFactory extends Factory
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
            'student_id' => $this->faker->numberBetween(1, 300),
            'school_year_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
