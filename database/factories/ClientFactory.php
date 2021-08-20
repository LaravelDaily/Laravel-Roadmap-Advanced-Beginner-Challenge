<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->company(),
            'vat_id'=>$this->faker->countryCode(2).$this->faker->numberBetween(0,10000000),
            'zip_code'=>$this->faker->numberBetween(1000,99999),
            'city'=>$this->faker->city(),
            'address'=>$this->faker->address(),
            'created_by'=>$this->faker->numberBetween(2,16)
        ];
    }
}
