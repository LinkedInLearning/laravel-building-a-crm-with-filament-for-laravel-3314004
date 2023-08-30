<?php

use App\Filament\Resources\ClientResource\Pages\CreateClient;
use App\Models\Client;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('can create client', function () {
    actingAs(User::factory()->make());

    $firstName =fake()->firstName;
    $lastName =fake()->lastName;
    $email =fake()->email;

    livewire(CreateClient::class)
        ->assertFormExists()
        ->fillForm([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $clients = Client::all();

    expect($clients)
        ->toHaveCount(1)
        ->and($clients->first())
        ->toMatchArray([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
        ]);
});

