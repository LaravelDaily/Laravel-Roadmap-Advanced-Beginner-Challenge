<?php

namespace Controllers\Project;

use App\Enums\Project\ProjectStatusEnum;
use App\Http\Controllers\Crm\Project\ProjectController;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Database\Factories\ClientFactory;
use Database\Factories\ProjectFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_index_page_success()
    {
        $this->withoutExceptionHandling();

        $this->createUsers(1);
        $this->createClients(1);

        $projects = $this->createProjects(10);

        $res = $this->get('/crm/projects');

        $res->assertViewIs('crm.project.index');

        $res->assertSeeText('Projects');

        $titles = $projects->pluck('title')->toArray();
        $statuses = $projects->pluck('status')->toArray();
        $deadline = $projects->pluck('deadline')->toArray();
        $res->assertSeeText($titles);
        $res->assertSeeText($statuses);
        $res->assertSeeText($deadline);
    }

    public function test_it_can_be_stored_success()
    {
        $this->withoutExceptionHandling();

        $this->createUsers(1);
        $this->createClients(1);

        $data = $this->validParams();

        $res = $this->post(action([ProjectController::class, 'store'], $data));

        $res->assertRedirect('/crm/projects');

        $this->assertDatabaseCount('projects', 1);

        $project = Project::query()->first();

        $this->assertEquals($data['title'], $project->title);
        $this->assertEquals($data['description'], $project->description);
        $this->assertEquals($data['status'], $project->status->value);
        $this->assertEquals($data['deadline'], $project->deadline);
        $this->assertEquals($data['client_id'], $project->client_id);
        $this->assertEquals($data['user_id'], $project->user_id);
    }

    public function test_it_can_be_updated_success()
    {
        $this->withoutExceptionHandling();

        $this->createUsers(1);
        $this->createClients(1);

        $project = ProjectFactory::new()->create();

        $data = $this->validParams();
        $data['description'] = 'description changed';
        $data['title'] = 'changed';

        $res = $this->patch('/crm/projects/' . $project->id, $data);

        $res->assertOk();

        $updatedProject = Project::query()->first();
        $this->assertEquals($data['title'], $updatedProject->title);
        $this->assertEquals($data['description'], $updatedProject->description);

        $this->assertEquals($project->id, $updatedProject->id);
    }

    public function test_attribute_title_is_required_for_storing_project()
    {
        $this->createUsers(1);
        $this->createClients(1);

        $data = $this->validParams();
        $data['title'] = '';

        $res = $this->post('/crm/projects', $data);

        $res->assertRedirect();
        $res->assertInvalid('title');
    }

    public function test_it_show_page_success()
    {
        $this->withoutExceptionHandling();

        $this->createUsers(1);
        $this->createClients(1);

        $project = ProjectFactory::new()->create();

        $res = $this->get('/crm/projects/' . $project->id);

        $res->assertSeeText('Project');
        $res->assertViewIs('crm.project.show');
        $res->assertSeeText($project->title);
        $res->assertSeeText($project->description);
    }

    public function test_it_can_be_deleted_success()
    {
        $this->createUsers(1);
        $this->createClients(1);
        $project = ProjectFactory::new()->create();

        $res = $this->delete('/crm/projects/' . $project->id);
        $res->assertRedirect('/crm/projects');

        $this->assertDatabaseCount('projects', 0);
    }


    /**
     * Valid params for updating or creating a resource
     *
     * @param array $overrides new params
     * @return array Valid params for updating or creating a resource
     */
    private function validParams($overrides = []): array
    {
        return array_merge([
            'title' => 'hello world',
            'description' => "I'm a content",
            'deadline' => '2017-09-16',
            'status' => 'open',
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'client_id' => Client::query()->inRandomOrder()->value('id'),
        ], $overrides);
    }

    private function createUsers($count)
    {
        return UserFactory::new()->count($count)->create();
    }

    private function createClients($count)
    {
        return ClientFactory::new()->count($count)->create();
    }

    private function createProjects($count)
    {
        return ProjectFactory::new()->count($count)->create();
    }
}
