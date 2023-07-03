<?php

namespace Database\Factories;

use App\Enums\Project\ProjectStatusEnum;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;
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
            'deadline' => $this->faker->dateTimeBetween('+1 week', '+3 week'),
            'status' => $this->faker->randomElement(ProjectStatusEnum::cases()),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'client_id' => Client::query()->inRandomOrder()->value('id'),
        ];
    }
}
