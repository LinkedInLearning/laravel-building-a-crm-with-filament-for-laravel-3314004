<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\Meeting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $clients = Client::factory(100)->create();
        $countries = Country::factory(5)->create();

        $cities = City::factory(20)
            ->recycle($countries)
            ->state([
                'country_id' => Country::factory()
            ])
            ->create();

        Address::factory(200)
            ->recycle([$clients, $cities])
            ->state([
                'client_id' => Client::factory(),
                'city_id' => City::factory()
            ])
            ->create();

        Meeting::factory(20)
            ->recycle($clients)
            ->state(['client_id' => Client::factory()])
            ->create();
    }
}
