<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_company' => $this->faker->company,
            'description_company' => $this->faker->text(50),
            'vat_company' => $this->faker->randomNumber(5),
            'zip_company' => $this->faker->randomNumber(5),
            'address_company' => $this->faker->address,
            'city_company' => $this->faker->city,
            'name_manager' => ucfirst($this->faker->name),
            'email_manager' => $this->faker->email,
            'phone_manager' => $this->faker->phoneNumber,
        ];
    }
}
