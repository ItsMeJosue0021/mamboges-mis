<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guardian>
 */
class GuardianFactory extends Factory
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
            'email' => fake()->unique()->safeEmail(),
            'contact_no' => $this->faker->unique()->numerify('09#########'),
            'address' => $this->faker->address(),
        ];
    }
}
