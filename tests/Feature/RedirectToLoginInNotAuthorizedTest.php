<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectToLoginInNotAuthorizedTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_from_root_to_login()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertLocation('/login');
    }

    public function test_redirect_from_internal_pages_to_login()
    {
        $response = $this->get(route('dashboard'));
        $response->assertStatus(302);
        $response->assertLocation('/login');

        $response = $this->get(route('user.index'));
        $response->assertStatus(302);
        $response->assertLocation('/login');

        $response = $this->get(route('user.create'));
        $response->assertStatus(302);
        $response->assertLocation('/login');

        $response = $this->get(route('user.show', ['user' => 1]));
        $response->assertStatus(302);
        $response->assertLocation('/login');
    }
}
