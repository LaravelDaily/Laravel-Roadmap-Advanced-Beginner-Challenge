<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Models\Task;
use App\Models\Project;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_clients()
    {
        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->get('/admin/clients');

        //Assert
        $response->assertStatus(200);
    }

    public function test_post_client(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->post('/admin/clients', [
            'name' => 'client',
            'vat' => 98547,
            'adress' => 'adress'
        ]);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/clients');
    }

   public function test_put_client(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $new_data = [
            'name' => 'client_new',
            'vat' => 98547,
            'adress' => 'adress_new'
        ];
        $client = Client::factory()->create([
            'name' => 'client_old',
            'vat' => 98547,
            'adress' => 'adress_old'
        ]);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->put('/admin/clients/'.$client->id, $new_data);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/clients');
        $this->assertNotEquals($new_data['name'], $client->name);
        $this->assertNotEquals($new_data['adress'], $client->adress);
    }

    public function test_delete_client(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $client = Client::factory()->times(1)->create()->first();

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->delete('/admin/clients/'.$client->id);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/clients');
        $this->assertDatabaseMissing('clients', $client->toArray());

    }
}
