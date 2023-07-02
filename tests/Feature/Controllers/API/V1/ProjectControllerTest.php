<?php

namespace Controllers\API\V1;

use App\Enums\Project\ProjectStatusEnum;
use App\Models\Client;
use App\Models\User;
use Database\Factories\ClientFactory;
use Database\Factories\ProjectFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\AttachJwt;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
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

        $data = $this->validParams();

        $this->actingAs($this->user)
            ->post($this->baseUri($this->token, 'project'), $data)
            ->assertCreated();

        $this->assertDatabaseHas('projects', $data);
    }

    public function test_can_be_updated()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();

        $project = ProjectFactory::new()->create();
        $data = $this->validParams();

        $this->actingAs($this->user)
            ->patch($this->baseUri($this->token, 'project', $project->id), $data)
            ->assertOk();

        $project->refresh();

        $this->assertDatabaseHas('projects', $data);
        $this->assertEquals($data['title'], $project->title);
        $this->assertEquals($data['description'], $project->description);
    }

    public function test_get_projects()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();
        ProjectFactory::new()->count(2)->create();

        $this->actingAs($this->user)
            ->get($this->baseUri($this->token, 'project'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [[
                    'id',
                    'title',
                    'description',
                    'deadline',
                    'status',
                    'client' => [
                        'id',
                        'title',
                        'description',
                        'vat',
                        'zip',
                        'name',
                        'email',
                        'phone',
                        'address',
                        'city',
                    ],
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'role'
                    ],
                ]]
            ]);
    }

    public function test_attribute_title_is_required_for_storing_project()
    {
        $data = $this->validParams();
        $data['title'] = '';

        $res = $this->actingAs($this->user)
            ->post($this->baseUri($this->token, 'project'), $data);

        $res->assertStatus(422);
        $res->assertInvalid('title');
    }

    public function test_response_for_route_projects_show()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();
        $project = ProjectFactory::new()->create();

        $res = $this->actingAs($this->user)
            ->get($this->baseUri($this->token, 'project', $project->id))
            ->assertOk();

        $res->assertJson(['data' => [
            'id' => $project->id,
            'title' => $project->title,
            'description' => $project->description,
            'deadline' => $project->deadline,
            'status' => $project->status->value,
            'client' => [
                'id' => $project->client->id,
                'title' => $project->client->title_company,
                'description' => $project->client->description_company,
                'vat' => $project->client->vat_company,
                'zip' => $project->client->zip_company,
                'name' => $project->client->name_manager,
                'email' => $project->client->email_manager,
                'phone' => $project->client->phone_manager,
                'address' => $project->client->address_company,
                'city' => $project->client->city_company,
            ],
            'user' => [
                'id' => $project->user->id,
                'name' => $project->user->name,
                'email' => $project->user->email,
                'role' => $project->user->role,
            ]
        ]]);
    }

    public function test_project_can_be_deleted_by_auth_user()
    {
        $this->withoutExceptionHandling();

        ClientFactory::new()->create();
        $project = ProjectFactory::new()->create();

        $res = $this->actingAs($this->user)
            ->delete($this->baseUri($this->token,'project', $project->id));

        $res->assertOk();

        $this->assertDatabaseCount('projects', 0);

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
            'deadline' => '2017-09-16',
            'status' => ProjectStatusEnum::Open->value,
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'client_id' => Client::query()->inRandomOrder()->value('id'),
        ], $overrides);
    }
}
