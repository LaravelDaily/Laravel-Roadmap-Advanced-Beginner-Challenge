<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Database\Seeders\ClientSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TaskSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCrudAsAdminTest extends TestCase
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
        $this->seed(ProjectSeeder::class);
        $this->seed(TaskSeeder::class);

        $this->admin = User::first();
    }

    public function test_admin_access_to_task_index()
    {
        $this->actingAs($this->admin)
             ->from(route('dashboard'))
             ->get(route('task.index'))
             ->assertStatus(200)
             ->assertViewIs('task.index')
             ->assertViewHas('tasks');
    }

    public function test_admin_access_to_task_create()
    {
        $this->actingAs($this->admin)
             ->from(route('task.index'))
             ->get(route('task.create'))
             ->assertStatus(200)
             ->assertViewIs('task.create')
             ->assertSee('Task create');
    }

    public function test_admin_access_to_task_store()
    {
        $this->actingAs($this->admin)
             ->from(route('task.create'))
             ->post(route('task.store'), [
                 'title'       => 'Task title',
                 'description' => 'Task description',
                 'project_id'  => Project::inRandomOrder()->first()->id,
                 'status_id'   => 1,
             ])
             ->assertStatus(302)
             ->assertRedirect(route('task.edit', Task::orderBy('id', 'DESC')->first()->id))
             ->assertSessionHas('created');

        $this->assertDatabaseHas('tasks', [
            'title'       => 'Task title',
            'description' => 'Task description',
            'status_id'   => 1,
        ]);
    }

    public function test_admin_access_to_task_show()
    {
        $taskToShow = Task::first();

        $this->actingAs($this->admin)
             ->from(route('task.index'))
             ->get(route('task.show', $taskToShow->id))
             ->assertStatus(200)
             ->assertViewIs('task.show')
             ->assertViewHas('task')
             ->assertSee([$taskToShow->title, $taskToShow->description]);
    }

    public function test_admin_access_to_task_edit()
    {
        $taskToUpdate = Task::first();

        $this->actingAs($this->admin)
             ->from(route('task.index'))
             ->get(route('task.edit', $taskToUpdate->id))
             ->assertStatus(200)
             ->assertViewIs('task.edit')
             ->assertViewHas('task')
             ->assertSee('Task edit');
    }

    public function test_admin_access_to_task_update()
    {
        $taskToUpdate = Task::first();

        $this->actingAs($this->admin)
             ->from(route('task.edit', $taskToUpdate->id))
             ->put(route('task.update', $taskToUpdate->id), [
                 'title'       => 'Task title updated',
                 'description' => 'Task description updated',
                 'project_id'  => $taskToUpdate->project_id,
                 'status_id'   => $taskToUpdate->status_id,
             ])
             ->assertStatus(302)
             ->assertRedirect(route('task.edit', $taskToUpdate->id))
             ->assertSessionHas('updated');

        $this->assertDatabaseHas('tasks', [
            'title'       => 'Task title updated',
            'description' => 'Task description updated',
        ]);

        $updatedProject = Task::first();

        $this->assertEquals('Task title updated', $updatedProject->title);
    }

    public function test_admin_access_to_task_destroy()
    {
        $taskToDelete = Task::first();

        $this->actingAs($this->admin)
             ->from(route('task.index'))
             ->delete(route('task.destroy', $taskToDelete->id))
             ->assertStatus(302)
             ->assertRedirect(route('task.index'))
             ->assertSessionHas('deleted');

        $this->assertDatabaseMissing('tasks', [
            'id'         => $taskToDelete->id,
            'deleted_at' => null,
        ]);
    }

    public function test_admin_access_to_task_deleted()
    {
        $this->actingAs($this->admin)
             ->from(route('task.index'))
             ->get(route('task.deleted'))
             ->assertStatus(200)
             ->assertViewIs('task.index')
             ->assertViewHas('tasks');
    }

    public function test_admin_access_to_task_restore()
    {
        Task::first()->delete();
        $taskDeleted = Task::onlyTrashed()->first();

        $this->actingAs($this->admin)
             ->from(route('task.deleted'))
             ->post(route('task.restore', $taskDeleted->id))
             ->assertStatus(302)
             ->assertRedirect(route('task.deleted'))
             ->assertSessionHas('restored');

        $this->assertDatabaseHas('tasks', [
            'id'         => $taskDeleted->id,
            'deleted_at' => null,
        ]);
    }

    public function test_admin_access_to_task_add_response()
    {
        $task = Task::first();

        $this->actingAs($this->admin)
             ->from(route('task.show', $task->id))
             ->post(route('task.add-response'), [
                 'content' => 'Response content',
                 'task_id' => encrypt($task->id),
             ])
             ->assertStatus(302)
             ->assertRedirect(route('task.show', $task->id))
             ->assertSessionHas('responseCreated');

        $this->assertDatabaseHas('responses', [
            'content' => 'Response content',
            'task_id' => $task->id,
            'user_id' => $this->admin->id,
        ]);
    }
}
