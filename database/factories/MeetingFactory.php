<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start' => fake()->dateTimeBetween('now', '+30 days'),
            'end' => fake()->dateTimeBetween('+30 days', '+60 days'),
            'summary' => fake()->sentence,
            'title' => fake()->word,
            'client_id' => function () {
                return Client::factory()->create()->id;
            },
        ];
    }
}
