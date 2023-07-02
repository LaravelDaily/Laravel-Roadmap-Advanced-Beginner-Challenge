<?php

namespace Controllers\API\V1;

use App\Enums\Project\ProjectStatusEnum;
use App\Enums\Task\TaskStatusesEnum;
use App\Enums\User\UserRoleEnum;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Database\Factories\ClientFactory;
use Database\Factories\ProjectFactory;
use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\AttachJwt;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase, AttachJwt;

    private User $user;
    private string $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'accept' => 'application/Json'
        ]);

        $this->user = $this->createUser();
        $this->token = $this->generateToken($this->user);
    }


    public function test_can_be_stored()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();
        ProjectFactory::new()->create();

        $data = $this->validParams();

        $this->actingAs($this->user)
            ->post($this->baseUri($this->token, 'task'), $data)
            ->assertCreated();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_can_be_updated()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();
        ProjectFactory::new()->create();

        $task = TaskFactory::new()->create();
        $data = $this->validParams();

        $this->actingAs($this->user)
            ->patch($this->baseUri($this->token, 'task', $task->id), $data)
            ->assertOk();

        $task->refresh();

        $this->assertDatabaseHas('tasks', $data);
        $this->assertEquals($data['title'], $task->title);
        $this->assertEquals($data['description'], $task->description);
    }

    public function test_get_tasks()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();
        ProjectFactory::new()->create();
        TaskFactory::new()->count(2)->create();

        $this->actingAs($this->user)
            ->get($this->baseUri($this->token, 'task'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [[
                    'id',
                    'title',
                    'description',
                    'priority',
                    'status',
                    'client_id',
                    'user_id',
                    'project_id',
                ]]
            ]);
    }

    public function test_attribute_title_is_required_for_storing_task()
    {
        $data = $this->validParams();
        $data['title'] = '';

        $res = $this->actingAs($this->user)
            ->post($this->baseUri($this->token, 'task'), $data);

        $res->assertStatus(422);
        $res->assertInvalid('title');
    }

    public function test_response_for_route_tasks_show()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();
        ProjectFactory::new()->create();
        $task = TaskFactory::new()->create();

        $res = $this->actingAs($this->user)
            ->get($this->baseUri($this->token, 'task', $task->id))
            ->assertOk();

        $res->assertJson(['data' => [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'priority' => $task->priority,
            'status' => $task->status->value,
            'user_id' => $task->user_id,
            'client_id' => $task->client_id,
            'project_id' => $task->project_id,
        ]]);
    }

    public function test_task_can_be_deleted_by_auth_user()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();
        ProjectFactory::new()->create();
        $task = TaskFactory::new()->create();

        $res = $this->actingAs($this->user)
            ->delete($this->baseUri($this->token,'task', $task->id));

        $res->assertOk();

        $this->assertDatabaseCount('tasks', 0);

        $res->assertJson([
            'message' => 'deleted'
        ]);
    }


    public function createUser(): User
    {
        return UserFactory::new()->create();
    }


    /**
     * Valid params for updating or creating a resource
     *
     * @param array $overrides new params
     * @return array Valid params for updating or creating a resource
     */
    private function validParams(array $overrides = []): array
    {
        return array_merge([
            'title' => 'hello world',
            'description' => "I'm a content",
            'priority' => 2,
            'status' => TaskStatusesEnum::Add->value,
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'client_id' => Client::query()->inRandomOrder()->value('id'),
            'project_id' => Project::query()->inRandomOrder()->value('id'),
        ], $overrides);
    }
}
