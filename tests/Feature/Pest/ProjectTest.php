<?php

use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->seed([
        PermissionSeeder::class,
        RoleSeeder::class,
    ]);
    $user = User::factory()->create();
    $client = Client::factory()->create();
    $this->project = Project::factory()->create([
        'user_id' => $user->id,
        'client_id' => $client->id,
    ]);
});

test('admin can see project list', function () {
    asAdmin()
        ->get(route('projects.index'))
        ->assertStatus(200)
        ->assertViewHas('projects', function (LengthAwarePaginator $collection) {
            return $collection->contains($this->project);
        });
});

test('admin can create a new project', function () {
    $newProjectData = [
        'title' => 'new-title',
        'description' => 'new-description',
        'deadline' => now()->addDay(10),
        'user_id' => 1,
        'client_id' => 1,
        'status' => true,
    ];

    asAdmin()
        ->post(route('projects.store'), $newProjectData)
        ->assertStatus(302)
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects', $newProjectData);
});

test('admin can update project', function () {
    $updatingProjectNewData = [
        'title' => 'updated-title',
        'description' => 'updated-description',
    ];

    asAdmin()
        ->put(route('projects.update', $this->project), $updatingProjectNewData)
        ->assertStatus(302)
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects', $updatingProjectNewData);
    $this->project->refresh();

    expect($this->project->title)->toBe($updatingProjectNewData['title'])
        ->and($this->project->description)->toBe($updatingProjectNewData['description']);
});

test('admin can delete project', function () {
    asAdmin()
        ->delete(route('projects.destroy', $this->project))
        ->assertStatus(302)
        ->assertRedirect(route('projects.index'));

    $this->assertSoftDeleted($this->project);
});
