<?php

namespace Database\Factories;

use App\Models\Client;
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
            'title' => fake()->title(),
            'client_id' => Client::factory()->create(),
            'description' => fake()->sentence(),
            'start_date' => fake()->date(),
            'budget' => fake()->numberBetween(100, 10000),
            'project_status' => fake()->randomElement(['On hold', 'Inactive']),
        ];
    }
}
