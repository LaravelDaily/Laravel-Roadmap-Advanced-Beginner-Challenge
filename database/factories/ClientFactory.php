<?php

namespace Database\Factories;

use App\Models\User;
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
            'image' => fake()->imageUrl(),
            'client_status' => fake()->randomElement(['Active', 'Inactive']),
            'user_id' => collect(User::all()->modelKeys())->random(),
        ];
    }
}
