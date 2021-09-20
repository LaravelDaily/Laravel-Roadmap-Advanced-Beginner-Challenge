<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RedirectToRootAuthorizedTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->seed(PermissionSeeder::class);
    }

    public function test_admin_login_redirect_to_dashboard()
    {
        $admin = User::first();

        $response = $this->from(route('login'))
                         ->post(route('login'), [
                             'email'    => 'admin@mail.com',
                             'password' => 'admin',
                         ]);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_wrong_user_login_redirect_back_to_login_form()
    {
        $response = $this->from(route('login'))
                         ->post(route('login'), [
                             'email'    => 'wrong@mail.com',
                             'password' => 'pass',
                         ]);

        $response->assertSessionHasErrors();
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
