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
            'title' => fake()->title,
            'description' => fake()->realText(),
            'deadline' => fake()->date(),
            'status' => fake()->randomElements(['open', 'close']),
            'user_id' => User::all()->random(),
            'client_id' => Client::all()->random(),
        ];
    }
}
