<?php

namespace Tests\Unit;

use App\Enums\User\UserRoleEnum;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminAuthorized()
    {
        $admin = UserFactory::new()->create();
        $admin->role = UserRoleEnum::Admin;

        $this->actingAs($admin)
            ->get('/crm/tasks')
            ->assertOk();
    }

    public function testAdminForbidden()
    {
        $manager = UserFactory::new()->create();
        $manager->role = UserRoleEnum::Manager->value;

        $this->actingAs($manager)
            ->get('/crm/tasks')
            ->assertStatus(404);
    }
}
