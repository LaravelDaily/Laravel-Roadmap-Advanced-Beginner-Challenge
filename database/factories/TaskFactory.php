<?php

namespace Database\Factories;

use App\Enums\Project\ProjectStatusEnum;
use App\Enums\Task\TaskStatusesEnum;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(5, true),
            'description' => $this->faker->text(50),
            'priority' => $this->faker->numberBetween(0, 5),
            'status' => $this->faker->randomElement(TaskStatusesEnum::cases()),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'client_id' => Client::query()->inRandomOrder()->value('id'),
            'project_id' => Project::query()->inRandomOrder()->value('id'),
        ];
    }
}
