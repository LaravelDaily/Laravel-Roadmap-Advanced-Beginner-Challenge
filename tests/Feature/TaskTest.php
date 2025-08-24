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

class TaskTest extends TestCase
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
    public function test_access_tasks()
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
        $response = $this->actingAs($user)->get('/admin/tasks');

        //Assert
        $response->assertStatus(200);
    }

    public function test_post_task(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $client = Client::factory()->create();

        $project = Project::factory()->create([
            'client_id' => $client->id,
            'user_id' => $user->id
        ]);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->post('/admin/tasks', [
            'project_id' => $project->id,
            'name' => 'client',
            'description' => 'description',
            'completed' => 1
        ]);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/tasks');
    }

   public function test_put_task(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $client = Client::factory()->times(1)->create();

        $project = Project::factory()->times(1)->create([
            'client_id' => 1,
            'user_id' => 1
        ]);

        $new_data = [
            'project_id' => $project->first()->id,
            'name' => 'new_client',
            'description' => 'new_description',
            'completed' => 1
        ];
        $task = Task::factory()->create([
            'project_id' => $project->first()->id,
            'name' => 'old_client',
            'description' => 'old_description',
            'completed' => 1
        ]);

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->put('/admin/tasks/'.$task->id, $new_data);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/tasks');
        $this->assertNotEquals($new_data['name'], $task->name);
        $this->assertNotEquals($new_data['description'], $task->description);
    }

    public function test_delete_task(){

        //Arrange
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        $client = Client::factory()->times(1)->create();

        $project = Project::factory()->times(1)->create([
            'client_id' => 1,
            'user_id' => 1
        ]);

        $task = Task::factory()->create([
            'project_id' => $project->first()->id,
            'name' => 'old_client',
            'description' => 'old_description',
            'completed' => 1
        ]);
        //dd(Task::all()->count());

        $user->assignRole('Super Admin');

        //Act
        $response = $this->actingAs($user)->delete('/admin/tasks/'.$task->id);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/tasks');
        $this->assertDatabaseMissing('tasks', $task->toArray());

    }
}
