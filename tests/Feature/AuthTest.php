<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthenticated_user_cannot_access()
    {
        //Arrange

        //Act
        $response = $this->get('/user/projects');

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }


    public function test_login_redirect_to_products()
    {
        //Arrange
        $user = User::create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => bcrypt('password123'),
            'is_admin' => 1
        ]);

        //Act
        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password123'
        ]);

        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/projects');
    }
}
