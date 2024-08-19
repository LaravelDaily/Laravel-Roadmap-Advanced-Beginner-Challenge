<?php

namespace Tests\Feature\PHPUnit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_application_status_is_up(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
