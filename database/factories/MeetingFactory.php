<?php

namespace Database\Factories;

use App\Models\Client;
use Carbon\Carbon;
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
        $start = fake()->dateTimeBetween('now', '+30 days');
        $end = Carbon::createFromDate($start);

        return [
            'start' => $start,
            'end' => $end->addHours(fake()->numberBetween(1, 3)),
            'summary' => fake()->sentence,
            'title' => fake()->word,
            'client_id' => function () {
                return Client::factory()->create()->id;
            },
        ];
    }
}
