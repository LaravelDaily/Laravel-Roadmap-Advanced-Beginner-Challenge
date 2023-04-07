<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{

    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->randomElement([1,2]),
            'user_id' => $this->faker->randomElement([1]),
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'deadline' => $this->faker->date(),
            'status' => 'active',
        ];
    }
}
