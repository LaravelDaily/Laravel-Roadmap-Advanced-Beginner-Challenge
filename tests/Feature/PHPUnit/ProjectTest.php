<?php

namespace Tests\Feature\PHPUnit;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Database\Factories\UserFactory;
use Database\Seeders\ClientSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    protected Project $project;

    protected function setUp(): void
    {
        parent::setUp();
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
    }
    /**
     * A basic feature test example.
     */
    public function test_admin_can_see_project_list(): void
    {
        $response = $this->asAdmin()->get(route('projects.index'));

        $response->assertStatus(200);
        $response->assertViewHas('projects', function (LengthAwarePaginator $collection) {
            return $collection->contains($this->project);
        });
    }

    public function test_admin_can_create_a_new_project()
    {
        $newProjectData = [
            'title' => 'new-title',
            'description' => 'new-description',
            'deadline' => now()->addDay(10),
            'user_id' => 1,
            'client_id' => 1,
            'status' => true,
        ];

        $response = $this->asAdmin()->post(route('projects.store'), $newProjectData);

        $response->assertStatus(302);
        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $newProjectData);
    }

    public function test_admin_can_update_project(): void
    {
        $updatingProjectNewData = [
            'title' => 'updated-title',
            'description' => 'updated-description',
        ];

        $response = $this->asAdmin()->put(route('projects.update', $this->project), $updatingProjectNewData);

        $response->assertStatus(302);
        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $updatingProjectNewData);

        $this->project->refresh();
        $this->assertEquals($this->project->only(['title', 'description']), $updatingProjectNewData,);
    }

    public function test_admin_can_delete_project()
    {
        $response = $this->asAdmin()->delete(route('projects.destroy', $this->project));

        $response->assertStatus(302);
        $response->assertRedirect(route('projects.index'));
        $response->assertSessionHas('message', 'Project deleted successfully.');
        $this->assertSoftDeleted($this->project);
    }
}
