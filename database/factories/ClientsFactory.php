<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Clients>
 */
final class ClientsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Clients::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->companyEmail,
            'phone_number' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'company_address' => $this->faker->address,
            'company_city' => $this->faker->city,
            'company_zip' => $this->faker->postcode,
            'company_vat' => $this->faker->numberBetween(10000, 99999),
        ];
    }
}
