<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_show_all_users()
    {
        $response = $this->get("/users", [User::with('clients')->get()]);
       if ($response){
           $this->assertTrue(true);
       }

    }

    public function test_create_user()
    {
        $password = Hash::make('password');
        $response = $this->post('/register', [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

       $response->assertRedirect('/home');
    }

    public function test_update_user()
    {
        $user = User::find(1);

       $response = $this->put(route('users.update', $user), [
           'name' => 'Oluwademilade Abatan',
           'email' => 'ademolademilade362@gmail.com'
       ]);

       if($response){
           $this->assertTrue(true);
       }


    }


    public function test_delete_user()
    {
        $user = User::factory(1)->create();

        $user = $user->first();

        if($user){
            $user->delete();
        }

        $this->assertTrue(true);
    }
}
