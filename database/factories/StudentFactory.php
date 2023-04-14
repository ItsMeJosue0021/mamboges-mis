<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->firstName(),
            'suffix' => $this->faker->optional()->suffix(),
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'lrn' => $this->faker->unique()->numerify('#########'),
            'dob' => $this->faker->date(),
            'address' => $this->faker->address(),
            'grade_level' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '6']),
            // 'section_id' => $this->faker->numberBetween(1, 20),
            'parent_id' => $this->faker->numberBetween(1, 100),
            'school_year_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
