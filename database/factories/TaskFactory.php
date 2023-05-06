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
    public function definition()
    {
        return [
            'title'=>fake()->title(),
            'description'=>fake()->text(),
            'deadline'=>fake()->date(),
            'status'=>'todo',
            'project_id'=>$this->faker->numberBetween(1, Project::count()),
            'user_id'=> $this->faker->numberBetween(1, User::count()),

        ];
    }
}
