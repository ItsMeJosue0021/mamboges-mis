<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faculty>
 */
class FacultyFactory extends Factory
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
            'middle_name' => $this->faker->lastName(),
            'suffix' => $this->faker->randomElement(['Mr.', 'Ms.', 'Mrs.']),
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'email' => fake()->unique()->safeEmail(), 
            'contact_no' => $this->faker->numerify('09#########'),
            'department_id' => $this->faker->numberBetween(1, 5),
            'school_year_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
