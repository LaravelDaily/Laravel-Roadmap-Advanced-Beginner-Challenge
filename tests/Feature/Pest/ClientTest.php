<?php

use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use function Pest\Laravel\seed;
use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    seed([
        PermissionSeeder::class,
        RoleSeeder::class,
    ]);

    $this->client = Client::factory()->create();
});

test('admin can see client list', function () {
    asAdmin()
        ->get(route('clients.index'))
        ->assertStatus(200)
        ->assertViewHas('clients', function (LengthAwarePaginator $collection) {
            return $collection->contains($this->client);
        });
});

test('admin can create new client', function () {
    $newClientData = [
        'company' => 'New Company',
        'vat' => '2312932',
        'address' => 'New Address',
    ];
    asAdmin()
        ->post(route('clients.store'), $newClientData)
        ->assertStatus(302)
        ->assertRedirect(route('clients.index'));

    $this->assertDatabaseHas('clients', $newClientData);
});

test('admin can update client', function () {
    $updatedClientData = [
        'company' => 'Updated Company',
        'vat' => 2222222,
        'address' => 'Updated Address',
    ];

    asAdmin()
        ->put(route('clients.update', $this->client), $updatedClientData)
        ->assertStatus(302)
        ->assertRedirect(route('clients.index'));

    $client = Client::find($this->client->id);
    expect($client->company)->toBe($updatedClientData['company'])
        ->and($client->vat)->toBe($updatedClientData['vat'])
        ->and($client->address)->toBe($updatedClientData['address']);
});

test('admin can delete client', function () {
    asAdmin()
        ->delete(route('clients.destroy', $this->client))
        ->assertStatus(302)
        ->assertRedirect(route('clients.index'));

    $this->assertSoftDeleted($this->client);
});
