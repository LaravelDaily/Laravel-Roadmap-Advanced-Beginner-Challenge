<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;

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
    public function definition()
    {
        $taskable = $this->faker->randomElement([
            \App\Models\Client::class,
            \App\Models\Project::class,
        ]);

        return [
            'title' => fake()->word(),
            'description' => fake()->text(),
            'due_date' => fake()->dateTime(),
            'priority' => fake()->randomElement(['high', 'medium', 'low']),
            'status' => fake()->randomElement(['pending', 'open', 'closed']),
            'taskable_type' => array_search($taskable, Relation::$morphMap),
            'taskable_id' => str_contains($taskable,'Project') ? $taskable::factory()->create(
                ['user_id' => 1]
            ) : $taskable::factory(),
        ];
    }
}
