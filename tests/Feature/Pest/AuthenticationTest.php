<?php

use function Pest\Laravel\get;
use function Pest\Laravel\post;
use App\Models\User;

test('login page can be rendered', function () {
    get('/login')->assertStatus(200);
});

test('user can login successfully', function () {
    $user = User::factory()->create();

    post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertStatus(302)
        ->assertRedirect(route('dashboard'));
});

test('user cannot login with invalid credentials', function () {

    post('/login', [
        'email' => 'wrong-email@example.com',
        'password' => 'wrong-password',
    ])
    ->assertStatus(302)
    ->assertRedirect('/');
});


