<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
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
            'title' => fake()->sentence(),
            'project_id' => collect(Project::all()->modelKeys())->random(),
            'description' => fake()->sentence(),
            'start_date' => fake()->date(),
            'task_status' => fake()->randomElement(['On hold', 'Inactive']),
            'image' => fake()->imageUrl(),
            'user_id' => collect(User::all()->modelKeys())->random(),
        ];
    }
}
