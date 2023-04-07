<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_projects()
    {
        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->get('/admin/projects');

        //Assert
        $response->assertStatus(200);
    }

    public function test_post_project(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $client = Client::factory()->create([
            'name' => 'name',
            'vat' => '12548',
            'adress' => 'adress',
        ]);

        Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->post('/admin/projects', [
            'client_id' => $client->id,
            'user_id' => $user->id,
            'title' => 'title',
            'description' => 'desc',
            'deadline' => '1984-01-13',
            'status' => 'active'
        ]);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/projects');
    }

    public function test_put_project(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $client = Client::factory()->create([
            'name' => 'name',
            'vat' => '12548',
            'adress' => 'adress',
        ]);

        $data = [
            'client_id' => $client->id,
            'user_id' => $user->id,
            'title' => 'title_old',
            'description' => 'desc_old',
            'deadline' => '1984-01-13',
            'status' => 'active'
        ];
        $project = Project::factory()->create([
            'client_id' => $client->id,
            'user_id' => $user->id,
            'deadline' => '1984-01-13',
            'status' => 'active'
        ]);

        Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->put('/admin/projects/'.$project->id, $data);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/projects');
        $this->assertNotEquals($data['title'], $project->title);
        $this->assertNotEquals($data['description'], $project->description);
    }

    public function test_delete_project(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $client = Client::factory()->create([
            'name' => 'name',
            'vat' => '12548',
            'adress' => 'adress',
        ]);

        $project = Project::factory()->create([
            'client_id' => $client->id,
            'user_id' => $user->id,
            'deadline' => '1984-01-13',
            'status' => 'active'
        ]);
        //dd(Project::all()->count());

        Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->delete('/admin/projects/'.$project->id);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/projects');
        $this->assertDatabaseMissing('projects', $project->toArray());
    }



}

