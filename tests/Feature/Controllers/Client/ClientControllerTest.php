<?php

namespace Controllers\Client;

use App\Http\Controllers\Crm\Client\ClientController;
use App\Models\Client;
use Database\Factories\ClientFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_index_page_success()
    {
        $this->withoutExceptionHandling();

        $clients = ClientFactory::new()->count(10)->create();

        $res = $this->get('/crm/clients');

        $res->assertViewIs('crm.client.index');

        $res->assertSeeText('Clients');

        $titles = $clients->pluck('title_company')->toArray();
        $vat = $clients->pluck('vat')->toArray();
        $address = $clients->pluck('address')->toArray();
        $res->assertSeeText($titles);
        $res->assertSeeText($vat);
        $res->assertSeeText($address);
    }

    public function test_it_can_be_stored_success()
    {
        $this->withoutExceptionHandling();

        $data = $this->validParams();

        $res = $this->post(action([ClientController::class, 'store'], $data));

        $res->assertRedirect('/crm/clients');

        $this->assertDatabaseCount('clients', 1);

        $client = Client::query()->first();

        $this->assertEquals($data['title_company'], $client->title_company);
        $this->assertEquals($data['description_company'], $client->description_company);
        $this->assertEquals($data['vat_company'], $client->vat_company);
        $this->assertEquals($data['zip_company'], $client->zip_company);
        $this->assertEquals($data['address_company'], $client->address_company);
        $this->assertEquals($data['city_company'], $client->city_company);
        $this->assertEquals($data['name_manager'], $client->name_manager);
        $this->assertEquals($data['email_manager'], $client->email_manager);
        $this->assertEquals($data['phone_manager'], $client->phone_manager);

    }

    public function test_it_can_be_updated_success()
    {
        $this->withoutExceptionHandling();

        $client = ClientFactory::new()->create();

        $data = $this->validParams();
        $data['description_company'] = 'description changed';
        $data['title_company'] = 'changed';

        $res = $this->patch('/crm/clients/' . $client->id, $data);

        $res->assertOk();

        $updatedClient = Client::query()->first();
        $this->assertEquals($data['title_company'], $updatedClient->title_company);
        $this->assertEquals($data['description_company'], $updatedClient->description_company);

        $this->assertEquals($client->id, $updatedClient->id);
    }

    public function test_attribute_title_company_is_required_for_storing_client()
    {
        $data = $this->validParams();
        $data['title_company'] = '';

        $res = $this->post('/crm/clients', $data);

        $res->assertRedirect();
        $res->assertInvalid('title_company');
    }

    public function test_it_show_page_success()
    {
        $this->withoutExceptionHandling();

        $client = ClientFactory::new()->create();

        $res = $this->get('/crm/clients/' . $client->id);

        $res->assertSeeText('Client');
        $res->assertViewIs('crm.client.show');
        $res->assertSeeText($client->title);
        $res->assertSeeText($client->description);
    }

    public function test_it_can_be_deleted_success()
    {
        $client = ClientFactory::new()->create();

        $res = $this->delete('/crm/clients/' . $client->id);
        $res->assertRedirect('/crm/clients');

        $this->assertDatabaseCount('clients', 0);
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
