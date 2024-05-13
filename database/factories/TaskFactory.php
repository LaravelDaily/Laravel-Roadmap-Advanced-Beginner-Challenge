<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->jobTitle,
            'description' => fake()->text,
            'status' => fake()->boolean,
            'deadline' => fake()->dateTime(now()->addWeek()),
            'project_id' => fake()->numberBetween(1, 10),
        ];
    }
}
