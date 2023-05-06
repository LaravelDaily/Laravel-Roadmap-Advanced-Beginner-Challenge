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
    public function definition()
    {
        return [
           'title'=>fake()->title(),
           'description'=>fake()->text(),
           'deadline'=>fake()->date(),
           'user_id'=>User::factory(),
            'client_id'=>$this->faker->numberBetween(1, Client::count()),
            'status'=>'todo',
        ];
    }
}
