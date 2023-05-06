<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'name'=>fake()->company(),
           'email' => fake()->unique()->safeEmail(),
           'phoneNumber'=>fake()->phoneNumber(),
           'VAT'=>fake()->phoneNumber(),
           'address'=>fake()->address(),


        ];
    }
}
