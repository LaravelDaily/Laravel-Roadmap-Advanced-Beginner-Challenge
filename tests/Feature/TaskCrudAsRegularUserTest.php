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

class TaskCrudAsRegularUserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        $this->seed(ClientSeeder::class);
        $this->seed(ProjectSeeder::class);
        $this->seed(TaskSeeder::class);

        $this->user = User::all()[1];
    }

    public function test_user_access_to_task_index()
    {
        $this->actingAs($this->user)
             ->from(route('dashboard'))
             ->get(route('task.index'))
             ->assertStatus(200)
             ->assertViewIs('task.index')
             ->assertViewHas('tasks');
    }

    public function test_user_unable_to_task_create()
    {
        $this->actingAs($this->user)
             ->from(route('task.index'))
             ->get(route('task.create'))
             ->assertStatus(403)
             ->assertDontSee('Task create');
    }

    public function test_user_unable_to_task_store()
    {
        $this->actingAs($this->user)
             ->from(route('task.create'))
             ->post(route('task.store'), [
                 'title'       => 'Task title',
                 'description' => 'Task description',
                 'project_id'  => Project::inRandomOrder()->first()->id,
                 'status_id'   => 1,
             ])
             ->assertStatus(403)
             ->assertSessionMissing('created');

        $this->assertDatabaseMissing('tasks', [
            'title'       => 'Task title',
            'description' => 'Task description',
            'status_id'   => 1,
        ]);
    }

    public function test_user_access_to_task_show()
    {
        $taskToShow = Task::first();

        $this->actingAs($this->user)
             ->from(route('task.index'))
             ->get(route('task.show', $taskToShow->id))
             ->assertStatus(200)
             ->assertViewIs('task.show')
             ->assertViewHas('task')
             ->assertSee([$taskToShow->title, $taskToShow->description]);
    }

    public function test_user_unable_to_task_edit()
    {
        $taskToUpdate = Task::first();

        $this->actingAs($this->user)
             ->from(route('task.index'))
             ->get(route('task.edit', $taskToUpdate->id))
             ->assertStatus(403)
             ->assertDontSee('Task edit');
    }

    public function test_user_unable_to_task_update()
    {
        $taskToUpdate = Task::first();

        $this->actingAs($this->user)
             ->from(route('task.edit', $taskToUpdate->id))
             ->put(route('task.update', $taskToUpdate->id), [
                 'title'       => 'Task title updated',
                 'description' => 'Task description updated',
                 'project_id'  => $taskToUpdate->project_id,
                 'status_id'   => $taskToUpdate->status_id,
             ])
             ->assertStatus(403)
             ->assertSessionMissing('updated');

        $this->assertDatabaseMissing('tasks', [
            'title'       => 'Task title updated',
            'description' => 'Task description updated',
        ]);

        $updatedTask = Task::first();

        $this->assertNotEquals('Task title updated', $updatedTask->title);
    }

    public function test_user_unable_to_task_destroy()
    {
        $taskToDelete = Task::first();

        $this->actingAs($this->user)
             ->from(route('task.index'))
             ->delete(route('task.destroy', $taskToDelete->id))
             ->assertStatus(403)
             ->assertSessionMissing('deleted');

        $this->assertDatabaseHas('tasks', [
            'id'         => $taskToDelete->id,
            'deleted_at' => null,
        ]);
    }

    public function test_user_access_to_task_deleted()
    {
        $this->actingAs($this->user)
             ->from(route('task.index'))
             ->get(route('task.deleted'))
             ->assertStatus(200)
             ->assertViewIs('task.index')
             ->assertViewHas('tasks');
    }

    public function test_user_unable_to_task_restore()
    {
        Task::first()->delete();
        $taskDeleted = Task::onlyTrashed()->first();

        $this->actingAs($this->user)
             ->from(route('task.deleted'))
             ->post(route('task.restore', $taskDeleted->id))
             ->assertStatus(403)
             ->assertSessionMissing('restored');

        $this->assertDatabaseMissing('tasks', [
            'id'         => $taskDeleted->id,
            'deleted_at' => null,
        ]);
    }

    public function test_non_assigned_user_unable_to_task_add_response()
    {
        $task = Task::whereHas('project.user', function ($query) {
            return $query->where('id', '!=', $this->user->id);
        })->first();

        $this->actingAs($this->user)
             ->from(route('task.show', $task->id))
             ->post(route('task.add-response'), [
                 'content' => 'Response content',
                 'task_id' => encrypt($task->id),
             ])
             ->assertStatus(403)
             ->assertSessionMissing('responseCreated');

        $this->assertDatabaseMissing('responses', [
            'content' => 'Response content',
            'task_id' => $task->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function test_assigned_user_access_to_task_add_response()
    {
        $task = Task::whereHas('project.user', function ($query) {
            return $query->where('id', '=', $this->user->id);
        })->first();

        $this->actingAs($this->user)
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
            'user_id' => $this->user->id,
        ]);
    }
}
