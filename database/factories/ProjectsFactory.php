<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Projects>
 */
final class ProjectsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Projects::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text,
            'user_id' => \App\Models\User::factory(),
            'client_id' => \App\Models\Clients::factory(),
            'deadline' => $this->faker->dateTimeBetween('10 days', '60 days'),
            'status' => $this->faker->randomElement(['open','canceled','pending', 'ongoing', 'completed']),
        ];
    }
}
