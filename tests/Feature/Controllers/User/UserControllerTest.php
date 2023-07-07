<?php

namespace Controllers\User;

use App\Http\Controllers\Crm\Client\ClientController;
use App\Http\Controllers\Crm\User\UserController;
use App\Models\Client;
use App\Models\User;
use Database\Factories\ClientFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = UserFactory::new()->create();
    }

    public function test_it_index_page_success()
    {
        $this->withoutExceptionHandling();

        $clients = UserFactory::new()->count(10)->create();

        $res = $this->actingAs($this->user)->get('/crm/users');

        $res->assertViewIs('crm.user.index');

        $res->assertSeeText('Users');

        $names = $clients->pluck('name')->toArray();
        $ids = $clients->pluck('id')->toArray();

        $res->assertSeeText($names);
        $res->assertSeeText($ids);
    }

    public function test_it_can_be_stored_success()
    {
        $this->withoutExceptionHandling();

        $data = $this->validParams();

        $this->actingAs($this->user)->post(action([UserController::class, 'store'], $data));

        $this->assertDatabaseCount('users', 2);

        $user = User::query()->where('email', $data['email'])->first();

        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['role'], $user->role->value);
    }

    public function test_it_can_be_updated_success()
    {
        $this->withoutExceptionHandling();

        $user = UserFactory::new()->create();

        $data = $this->validParams();
        $data['user_id'] = $user->id;
        $data['name'] = 'name changed';
        $data['email'] = 'email12345@mail.com';

        $res = $this->actingAs($this->user)->patch('/crm/users/' . $user->id, $data);

        $res->assertOk();

        $updatedUser = User::query()->where('email', $data['email'])->first();
        $this->assertEquals($data['name'], $updatedUser->name);
        $this->assertEquals($data['email'], $updatedUser->email);

        $this->assertEquals($user->id, $updatedUser->id);
    }

    public function test_attribute_name_is_required_for_storing_user()
    {
        $data = $this->validParams();
        $data['name'] = '';

        $res = $this->actingAs($this->user)->post('/crm/users', $data);

        $res->assertRedirect();
        $res->assertInvalid('name');
    }

    public function test_it_show_page_success()
    {
        $this->withoutExceptionHandling();

        $user = UserFactory::new()->create();

        $res = $this->actingAs($this->user)->get('/crm/users/' . $user->id);

        $res->assertSeeText('User');
        $res->assertViewIs('crm.user.show');
        $res->assertSeeText($user->name);
        $res->assertSeeText($user->email);
        $res->assertSeeText($user->role);
    }

    public function test_it_can_be_deleted_success()
    {
        $user = UserFactory::new()->create();

        $res = $this->actingAs($this->user)->delete('/crm/users/' . $user->id);
        $res->assertRedirect();

        $this->assertSoftDeleted('users', [
           'id' => $user->id
        ]);
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
            'name' => 'hello world',
            'email' => "example@mail.ru",
            'role' => "admin",
        ], $overrides);
    }
}
