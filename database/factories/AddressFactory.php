<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'city_id' => 15101,
            'zipcode' => $this->faker->numerify('#####-###'),
            'address' => $this->faker->address(),
            'number' => $this->faker->numerify('###'),
            'district' => $this->faker->word(),
            'complement' => $this->faker->word(),
            'location' => $this->faker->word(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
