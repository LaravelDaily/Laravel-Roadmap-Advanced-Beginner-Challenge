<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Database\Seeders\ClientSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectCrudAsRegularUserTest extends TestCase
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

        $this->user = User::all()[1];
    }

    public function test_user_access_to_project_index()
    {
        $this->actingAs($this->user)
             ->from(route('dashboard'))
             ->get(route('project.index'))
             ->assertStatus(200)
             ->assertViewIs('project.index')
             ->assertViewHas('projects');
    }

    public function test_user_unable_to_project_create()
    {
        $this->actingAs($this->user)
             ->from(route('project.index'))
             ->get(route('project.create'))
             ->assertStatus(403)
             ->assertDontSee('Project create');
    }

    public function test_user_unable_to_project_store()
    {
        $this->actingAs($this->user)
             ->from(route('project.create'))
             ->post(route('project.store'), [
                 'title'       => 'Project title',
                 'description' => 'Project description',
                 'deadline'    => '2021-12-31',
                 'client_id'   => Client::inRandomOrder()->first()->id,
                 'user_id'     => User::inRandomOrder()->first()->id,
                 'status_id'   => 1,
             ])
             ->assertStatus(403)
             ->assertSessionMissing('created');

        $this->assertDatabaseMissing('projects', [
            'title'       => 'Project title',
            'description' => 'Project description',
            'deadline'    => '2021-12-31',
        ]);
    }

    public function test_user_access_to_project_show()
    {
        $projectToShow = Project::first();

        $this->actingAs($this->user)
             ->from(route('project.index'))
             ->get(route('project.show', $projectToShow->id))
             ->assertStatus(200)
             ->assertViewIs('project.show')
             ->assertViewHas('project')
             ->assertSee([$projectToShow->title, $projectToShow->description]);
    }

    public function test_user_unable_to_project_edit()
    {
        $projectToUpdate = Project::first();

        $this->actingAs($this->user)
             ->from(route('project.index'))
             ->get(route('project.edit', $projectToUpdate->id))
             ->assertStatus(403)
             ->assertDontSee('Project edit');
    }

    public function test_user_unable_to_project_update()
    {
        $projectToUpdate = Project::first();

        $this->actingAs($this->user)
             ->from(route('project.edit', $projectToUpdate->id))
             ->put(route('project.update', $projectToUpdate->id), [
                 'title'       => 'Project title updated',
                 'description' => 'Project description updated',
                 'deadline'    => '2022-01-31',
                 'client_id'   => $projectToUpdate->client_id,
                 'user_id'     => User::inRandomOrder()->first()->id,
                 'status_id'   => $projectToUpdate->status_id,
             ])
             ->assertStatus(403)
             ->assertSessionMissing('updated');

        $this->assertDatabaseMissing('projects', [
            'id'          => $projectToUpdate->id,
            'title'       => 'Project title updated',
            'description' => 'Project description updated',
            'deadline'    => '2022-01-31',
        ]);

        $updatedProject = Project::first();

        $this->assertNotEquals('Project title updated', $updatedProject->title);
    }

    public function test_user_unable_to_project_destroy()
    {
        $projectToDelete = Project::first();

        $this->actingAs($this->user)
             ->from(route('project.index'))
             ->delete(route('project.destroy', $projectToDelete->id))
             ->assertStatus(403)
             ->assertSessionMissing('deleted');

        $this->assertDatabaseHas('projects', [
            'id'         => $projectToDelete->id,
            'deleted_at' => null,
        ]);
    }

    public function test_user_access_to_project_deleted()
    {
        $this->actingAs($this->user)
             ->from(route('project.index'))
             ->get(route('project.deleted'))
             ->assertStatus(200)
             ->assertViewIs('project.index')
             ->assertViewHas('projects');
    }

    public function test_user_unable_to_project_restore()
    {
        Project::first()->delete();
        $projectDeleted = Project::onlyTrashed()->first();

        $this->actingAs($this->user)
             ->from(route('project.deleted'))
             ->post(route('project.restore', $projectDeleted->id))
             ->assertStatus(403)
             ->assertSessionMissing('restored');

        $this->assertDatabaseMissing('projects', [
            'id'         => $projectDeleted->id,
            'deleted_at' => null,
        ]);
    }
}
