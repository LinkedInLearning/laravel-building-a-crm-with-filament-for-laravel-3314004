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
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'company' => fake()->company,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber,
            'role' => fake()->jobTitle,
            'title' => fake()->jobTitle,
            'mobile' => fake()->phoneNumber,
            'linkedin' => fake()->url,
            'company_website' => fake()->url,
            'business_details' => fake()->text,
            'company_size' => fake()->randomElement(['small', 'mid', 'big']),
            'temperature' => fake()->randomElement(['cold', 'warm', 'hot']),
            'business_type' => fake()->word,
            'referrals' => fake()->text,
            'active' => fake()->boolean,
            'notes' => fake()->text,
            'photo' => fake()->imageUrl(200, 200, 'people', true),
        ];
    }
}
