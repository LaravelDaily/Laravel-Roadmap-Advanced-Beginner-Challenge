<?php

namespace Tests\Feature\PHPUnit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_can_login_successfully()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/login',[
            'email' => 'wrong-email@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
