<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(),
            'deadline' => $this->faker->date(),
            'user_id' => $this->faker->numberBetween(1, 5),
            'client_id' => $this->faker->numberBetween(1, 5),
            'status_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
