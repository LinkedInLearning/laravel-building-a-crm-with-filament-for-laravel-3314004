<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'street' => fake()->streetAddress,
            'zip' => fake()->postcode,
            'city_id' => function () {
                return City::factory()->create()->id;
            },
            'client_id' => function () {
                return Client::factory()->create()->id;
            },
        ];
    }
}
