<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * TaskFactory
 */
class TaskFactory extends Factory
{

    /**
     * definition
     *
     * @return array
     */
    public function definition(): array
    {
        $users = collect(User::all()->modelKeys());
        $clients = collect(Client::all()->modelKeys());
        $projects = collect(Project::all()->modelKeys());

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'user_id' => $users->random(),
            'client_id' => $clients->random(),
            'project_id' => $projects->random(),
            'deadline' => $this->faker->dateTimeBetween('+1 month', '+6 month'),
            'status' => Arr::random(Task::STATUS),
        ];
    }
}
