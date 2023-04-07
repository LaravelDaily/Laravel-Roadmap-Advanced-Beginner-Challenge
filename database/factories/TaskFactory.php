<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{

    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->randomElement([1,2,3,4,5]),
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(2),
            'completed' => $this->faker->boolean()
        ];
    }
}
