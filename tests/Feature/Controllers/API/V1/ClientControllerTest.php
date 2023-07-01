<?php

namespace Controllers\API\V1;

use App\Models\Client;
use App\Models\User;
use Database\Factories\ClientFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\AttachJwt;
use Tests\TestCase;

class ClientControllerTest extends TestCase
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

        $data = $this->validParams();

        $res = $this->actingAs($this->user)->post($this->baseUri($this->token), $data);

        $this->assertDatabaseCount('clients', 1);

        $client = Client::first();

        $this->assertEquals($data['title_company'], $client->title_company);

        $res->assertJson(['data' => $this->checkJson($client)]);
    }

    public function test_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $client = ClientFactory::new()->create();

        $data = $this->validParams();
        $data['title_company'] = 'title_changed';
        $data['description_company'] = 'description_changed';

        $res = $this->actingAs($this->user)
            ->patch($this->baseUri($this->token, $client->id), $data);

        $res->assertJson([
            'data' => [
                'id' => $client->id,
                'title' => $data['title_company'],
                'description' => $data['description_company'],
            ]
        ]);
    }

    public function test_attribute_title_is_required_for_storing_client()
    {
        $data = $this->validParams();
        $data['title_company'] = '';

        $res = $this->actingAs($this->user)
            ->post($this->baseUri($this->token), $data);

        $res->assertStatus(422);
        $res->assertInvalid('title_company');
    }

    public function test_response_for_route_clients_index()
    {
        $this->withoutExceptionHandling();

        $clients = ClientFactory::new()->count(10)->create();

        $res = $this->actingAs($this->user)->get($this->baseUri($this->token));

        $json = $clients->map(function ($client) {
            return $this->checkJson($client);
        })->toArray();

        $res->assertJson([
            'data' => $json
        ]);
    }

    public function test_response_for_route_clients_show()
    {
        $this->withoutExceptionHandling();

        $client = ClientFactory::new()->create();

        $res = $this->actingAs($this->user)
            ->get($this->baseUri($this->token, $client->id));

        $res->assertJson(['data' => $this->checkJson($client)]);
    }

    public function test_client_can_be_deleted_by_auth_user()
    {
        $this->withoutExceptionHandling();

        $client = ClientFactory::new()->create();
        $res = $this->actingAs($this->user)
            ->delete($this->baseUri($this->token, $client->id));

        $res->assertOk();

        $this->assertDatabaseCount('clients', 0);

        $res->assertJson([
            'message' => 'deleted'
        ]);
    }


    public function createUser(): User
    {
        return UserFactory::new()->create();
    }

    public function checkJson($client): array
    {
        return [
            'id' => $client->id,
            'title' => $client->title_company,
            'description' => $client->description_company,
            'vat' => $client->vat_company,
            'zip' => $client->id,
            'name' => $client->name_manager,
            'email' => $client->email_manager,
            'phone' => $client->phone_manager,
            'address' => $client->address_company,
            'city' => $client->city_company,
        ];
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
            'title_company' => 'hello world',
            'description_company' => "I'm a content",
            'vat_company' => 111111,
            'zip_company' => 111111,
            'address_company' => 'example address',
            'city_company' => 'London',
            'name_manager' => 'Bob',
            'email_manager' => 'Bob@mail.ru',
            'phone_manager' => '(831) 919-6601',
        ], $overrides);
    }


}
