<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;



/**
 * ProjectFactory
 */
class ProjectFactory extends Factory
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

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->realText(),
            'user_id' => $users->random(),
            'client_id' => $clients->random(),
            'deadline' => $this->faker->dateTimeBetween('+1 month', '+6 month'),
            'status' => Arr::random(Project::STATUS),
        ];
    }
}
