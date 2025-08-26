<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'client_id' => collect(Client::all()->modelKeys())->random(),
            'description' => fake()->sentence(),
            'start_date' => fake()->date(),
            'budget' => fake()->numberBetween(100, 10000),
            'project_status' => fake()->randomElement(['On hold', 'Inactive']),
            'image' => fake()->imageUrl(),
            'user_id' => collect(User::all()->modelKeys())->random(),
        ];
    }
}
