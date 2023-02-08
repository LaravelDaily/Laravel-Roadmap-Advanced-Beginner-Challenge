<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
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
            [
                'id' => Client::all()->random(),
                'type' => \App\Models\Client::class
            ],
            [
                'id' => Project::all()->random(),
                'type' => \App\Models\Project::class
            ]
        ]);

        return [
            'title' => fake()->word(),
            'description' => fake()->text(),
            'due_date' => fake()->dateTime(),
            'priority' => fake()->randomElement(['high', 'medium', 'low']),
            'status' => fake()->randomElement(['pending', 'open', 'closed']),
            'taskable_type' => array_search($taskable['type'], Relation::$morphMap),
            'taskable_id' => $taskable['id'],
        ];
    }
}
