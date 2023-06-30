<?php

namespace Controllers\Task;

use App\Enums\User\UserRoleEnum;
use App\Http\Controllers\Crm\Project\ProjectController;
use App\Http\Controllers\Crm\Task\TaskController;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Database\Factories\ClientFactory;
use Database\Factories\ProjectFactory;
use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = UserFactory::new()->create();
        $this->admin->role = UserRoleEnum::Admin;
    }

    public function test_it_index_page_admin_view_success()
    {
        $this->withoutExceptionHandling();

        $this->createUsers(5);
        $this->createClients(5);
        $this->createProjects(5);

        $tasks = $this->createTasks(10);

        $res = $this->actingAs($this->admin)->get('/crm/tasks');

        $res->assertViewIs('crm.task.index');

        $res->assertSeeText('Tasks');

        $titles = $tasks->pluck('title')->toArray();
        $statuses = $tasks->pluck('status')->toArray();
        $priority = $tasks->pluck('priority')->toArray();
        $res->assertSeeText($titles);
        $res->assertSeeText($statuses);
        $res->assertSeeText($priority);
    }

    public function test_it_index_page_manager_cant_see_success()
    {
        $manager = UserFactory::new()->create();

        $res = $this->actingAs($manager)->get('/crm/tasks');

        $res->assertStatus(404);
    }

    public function test_it_can_be_stored_success()
    {
        $this->withoutExceptionHandling();

        $this->createUsers(1);
        $this->createClients(1);
        $this->createProjects(1);

        $data = $this->validParams();

        $res = $this->actingAs($this->admin)->post(action([TaskController::class, 'store'], $data));

        $res->assertRedirect('/crm/tasks');

        $this->assertDatabaseCount('tasks', 1);

        $task = Task::query()->first();

        $this->assertEquals($data['title'], $task->title);
        $this->assertEquals($data['description'], $task->description);
        $this->assertEquals($data['status'], $task->status->value);
        $this->assertEquals($data['priority'], $task->priority);
        $this->assertEquals($data['client_id'], $task->client_id);
        $this->assertEquals($data['user_id'], $task->user_id);
        $this->assertEquals($data['project_id'], $task->project_id);
    }

    public function test_it_can_be_updated_success()
    {
        $this->withoutExceptionHandling();

        $this->createUsers(1);
        $this->createClients(1);
        $this->createProjects(1);

        $task = TaskFactory::new()->create();

        $data = $this->validParams();
        $data['description'] = 'description changed';
        $data['title'] = 'changed';

        $res = $this->actingAs($this->admin)->patch('/crm/tasks/' . $task->id, $data);

        $res->assertOk();

        $updatedTask = Task::query()->first();
        $this->assertEquals($data['title'], $updatedTask->title);
        $this->assertEquals($data['description'], $updatedTask->description);

        $this->assertEquals($task->id, $updatedTask->id);
    }

    public function test_attribute_title_is_required_for_storing_task()
    {
        $this->createUsers(1);
        $this->createClients(1);
        $this->createProjects(1);

        $data = $this->validParams();
        $data['title'] = '';

        $res = $this->actingAs($this->admin)->post('/crm/tasks', $data);

        $res->assertRedirect();
        $res->assertInvalid('title');
    }

    public function test_it_show_page_success()
    {
        $this->withoutExceptionHandling();

        $this->createUsers(1);
        $this->createClients(1);
        $this->createProjects(1);

        $task = TaskFactory::new()->create();

        $res = $this->actingAs($this->admin)->get('/crm/tasks/' . $task->id);

        $res->assertSeeText('Task');
        $res->assertViewIs('crm.task.show');
        $res->assertSeeText($task->title);
        $res->assertSeeText($task->description);
    }

    public function test_it_can_be_deleted_success()
    {
        $this->createUsers(1);
        $this->createClients(1);
        $this->createProjects(1);

        $task = TaskFactory::new()->create();

        $res = $this->actingAs($this->admin)->delete('/crm/tasks/' . $task->id);
        $res->assertRedirect('/crm/tasks');

        $this->assertDatabaseCount('tasks', 0);

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
            'priority' => 1,
            'status' => 'add',
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'client_id' => Client::query()->inRandomOrder()->value('id'),
            'project_id' => Project::query()->inRandomOrder()->value('id'),
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

    private function createTasks($count)
    {
        return TaskFactory::new()->count($count)->create();
    }
}
