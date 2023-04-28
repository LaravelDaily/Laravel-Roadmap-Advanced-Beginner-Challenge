<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'company' => fake()->company(),
            'email' => fake()->unique()->email(),
            'phone' => fake()->phoneNumber(),
            'country' => fake()->country(),
            'client_status' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
