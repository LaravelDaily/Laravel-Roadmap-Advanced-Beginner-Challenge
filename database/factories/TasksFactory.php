<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Tasks>
 */
final class TasksFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Tasks::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(1, 2)),
            'description' => $this->faker->text,
            'project_id' => $this->faker->numberBetween(1, 15),
            'deadline' => $this->faker->dateTimeBetween('1 days', '30 days'),
            'status' => $this->faker->randomElement(['open','canceled','pending', 'ongoing', 'completed']),
        ];
    }
}
