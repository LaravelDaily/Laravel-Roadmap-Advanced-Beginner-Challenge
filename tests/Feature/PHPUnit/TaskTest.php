<?php

namespace Tests\Feature\PHPUnit;

use App\Models\Task;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
        $this->task = Task::factory()->create();
    }
    /**
     * A basic feature test example.
     */
    public function test_admin_can_see_tasks_list(): void
    {
        $response = $this->asAdmin()->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewHas('tasks', function (LengthAwarePaginator $collection) {
            return $collection->contains($this->task);
        });
        $response->assertStatus(200);
    }

    public function test_admin_can_create_a_new_task()
    {
        $newTaskData = [
            'name' => 'New name',
            'description' => 'New description',
            'deadline' => now()->addDays(10),
            'project_id' => 1,
            'status' => true,
        ];

        $response = $this->asAdmin()->post(route('tasks.store'), $newTaskData);
        $response->assertStatus(302);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $newTaskData);
    }

    public function test_admin_can_update_task()
    {
        $newUpdatingTaskData = [
            'name' => 'Updated name',
            'description' => 'Updated description',
        ];

        $response = $this->asAdmin()->put(route('tasks.update', $this->task), $newUpdatingTaskData);
        $response->assertStatus(302);
        $response->assertRedirect(route('tasks.index'));

        $this->task->refresh();
        $this->assertEquals($this->task->only('name', 'description'), $newUpdatingTaskData);
    }

    public function test_admin_can_delete_a_task()
    {
        $response = $this->asAdmin()->delete(route('tasks.destroy', $this->task));
        $response->assertStatus(302);
        $response->assertRedirect(route('tasks.index'));
        $this->assertSoftDeleted($this->task);
    }
}
