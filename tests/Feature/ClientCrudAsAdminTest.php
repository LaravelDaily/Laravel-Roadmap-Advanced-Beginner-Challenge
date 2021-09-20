<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Database\Seeders\ClientSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientCrudAsAdminTest extends TestCase
{

    use RefreshDatabase;

    protected $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(ClientSeeder::class);

        $this->admin = User::first();
    }

    public function test_admin_access_to_client_index()
    {
        $this->actingAs($this->admin)
             ->from(route('dashboard'))
             ->get(route('client.index'))
             ->assertStatus(200)
             ->assertViewIs('client.index')
             ->assertViewHas('clients');
    }

    public function test_admin_access_to_client_create()
    {
        $this->actingAs($this->admin)
             ->from(route('client.index'))
             ->get(route('client.create'))
             ->assertStatus(200)
             ->assertViewIs('client.create')
             ->assertSee('Client create');
    }

    public function test_admin_access_to_client_store()
    {
        $this->actingAs($this->admin)
             ->from(route('client.create'))
             ->post(route('client.store'), [
                 'company' => 'Company name',
                 'vat'     => 'A123456789',
                 'address' => 'Company address 123',
             ])
             ->assertStatus(302)
             ->assertRedirect(route('client.index'))
             ->assertSessionHas('created');

        $this->assertDatabaseHas('clients', [
            'company' => 'Company name',
            'vat'     => 'A123456789',
            'address' => 'Company address 123',
        ]);
    }

    public function test_admin_access_to_client_edit()
    {
        $clientToUpdate = Client::first();

        $this->actingAs($this->admin)
             ->from(route('client.index'))
             ->get(route('client.edit', $clientToUpdate->id))
             ->assertStatus(200)
             ->assertViewIs('client.edit')
             ->assertViewHas('client')
             ->assertSee('Client edit');
    }

    public function test_admin_access_to_client_update()
    {
        $clientToUpdate = Client::first();

        $this->actingAs($this->admin)
             ->from(route('client.edit', $clientToUpdate->id))
             ->put(route('client.update', $clientToUpdate->id), [
                 'company' => 'Company name updated',
                 'vat'     => 'A1234567890',
                 'address' => 'Company address 456',
             ])
             ->assertStatus(302)
             ->assertRedirect(route('client.edit', $clientToUpdate->id))
             ->assertSessionHas('updated');

        $this->assertDatabaseHas('clients', [
            'id'      => $clientToUpdate->id,
            'company' => 'Company name updated',
            'vat'     => 'A1234567890',
            'address' => 'Company address 456',
        ]);

        $updatedClient = Client::first();

        $this->assertEquals('Company name updated', $updatedClient->company);
    }

    public function test_admin_access_to_client_destroy()
    {
        $clientToDelete = Client::first();

        $this->actingAs($this->admin)
             ->from(route('client.index'))
             ->delete(route('client.destroy', $clientToDelete->id))
             ->assertStatus(302)
             ->assertRedirect(route('client.index'))
             ->assertSessionHas('deleted');

        $this->assertDatabaseMissing('clients', [
            'id'         => $clientToDelete->id,
            'deleted_at' => null,
        ]);
    }

    public function test_admin_access_to_client_deleted()
    {
        $this->actingAs($this->admin)
             ->from(route('client.index'))
             ->get(route('client.deleted'))
             ->assertStatus(200)
             ->assertViewIs('client.index')
             ->assertViewHas('clients');
    }

    public function test_admin_access_to_client_restore()
    {
        Client::first()->delete();
        $clientDeleted = Client::onlyTrashed()->first();

        $this->actingAs($this->admin)
             ->from(route('client.deleted'))
             ->post(route('client.restore', $clientDeleted->id))
             ->assertStatus(302)
             ->assertRedirect(route('client.deleted'))
             ->assertSessionHas('restored');

        $this->assertDatabaseHas('clients', [
            'id'         => $clientDeleted->id,
            'deleted_at' => null,
        ]);
    }
}
