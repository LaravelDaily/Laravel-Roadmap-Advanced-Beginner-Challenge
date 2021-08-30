<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

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
            'project_id' => $this->faker->numberBetween(1, 5),
            'status_id' => $this->faker->numberBetween(1, 4)
        ];
    }
}
