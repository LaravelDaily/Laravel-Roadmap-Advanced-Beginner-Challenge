<?php

namespace Tests\Feature\PHPUnit;

use App\Models\Client;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
        $this->client = Client::factory()->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_admin_can_see_client_list(): void
    {
        $response = $this->asAdmin()->get(route('clients.index'));

        $response->assertStatus(200);
        $response->assertViewHas('clients', function (LengthAwarePaginator $collection) {
            return $collection->contains($this->client);
        });
    }
    public function test_admin_can_create_a_new_client(): void
    {
        $newClient = [
            'company' => 'New Company',
            'vat' => 12121212,
            'address' => 'New Address'
        ];

        $response = $this->asAdmin()->post(route('clients.store'), $newClient);

        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index'));
        $this->assertDatabaseHas('clients', $newClient);
    }

    public function test_admin_can_update_client()
    {
        $updatedClientData = [
            'company' => 'Updated Company',
            'vat' => 2222222,
            'address' => 'Updated Address',
        ];

        $response = $this->asAdmin()->put(route('clients.update', $this->client), $updatedClientData);
        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index'));

        $this->assertDatabaseHas('clients', $updatedClientData);

        $client = Client::find($this->client->id);
        $this->assertEquals($client->only(['company', 'vat', 'address']), $updatedClientData);
    }

    public function test_admin_can_delete_client()
    {
        $response = $this->asAdmin()->delete(route('clients.destroy', $this->client));

        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index'));
        $this->assertSoftDeleted($this->client);
    }
}
