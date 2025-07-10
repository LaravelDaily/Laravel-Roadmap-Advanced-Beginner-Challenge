<?php

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Task;
use Database\Seeders\DatabaseSeeder;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(DatabaseSeeder::class);
    $this->task = Task::factory()->create();
});

test('admin can see tasks list', function () {
    asAdmin()
        ->get(route('tasks.index'))
        ->assertStatus(200)
        ->assertViewHas('tasks', function (LengthAwarePaginator $collection) {
            return $collection->contains($this->task);
        });
});

test('admin can create a new task', function () {
    $newTaskData = [
        'name' => 'New name',
        'description' => 'New description',
        'deadline' => now()->addDays(10),
        'project_id' => 1,
        'status' => true,
    ];

    asAdmin()
        ->post(route('tasks.store'), $newTaskData)
        ->assertStatus(302)
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks', $newTaskData);
});

test('admin can update task', function () {
    $newUpdatingTaskData = [
        'name' => 'Updated name',
        'description' => 'Updated description',
    ];

    asAdmin()
        ->put(route('tasks.update', $this->task->id), $newUpdatingTaskData)
        ->assertStatus(302)
        ->assertRedirect(route('tasks.index'));

    $this->task->refresh();
    expect($this->task->only(['name', 'description']))->toBe($newUpdatingTaskData);
});

test('admin can delete a task', function () {
    asAdmin()
        ->delete(route('tasks.destroy', $this->task))
        ->assertStatus(302)
        ->assertRedirect(route('tasks.index'));

    $this->assertSoftDeleted($this->task);
});
