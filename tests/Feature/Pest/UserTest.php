<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    seed([
        \Database\Seeders\PermissionSeeder::class,
        \Database\Seeders\RoleSeeder::class,
    ]);
});

test('admin can see user page', function () {
    asAdmin()
        ->get('/users')
        ->assertStatus(200);
});

test('manager cannot see user page', function () {
    asManager()
        ->get('/users')
        ->assertStatus(403);
});

test('simple user cannot see user page', function () {
    asSimpleUser()
        ->get('/users')
        ->assertStatus(403);
});

test('user page contains user data', function () {
    $users = User::factory()->create();
    asAdmin()
        ->get('/users')
        ->assertStatus(200)
        ->assertViewHas('users', function (LengthAwarePaginator $collection) use ($users) {
            return $collection->contains($users);
        });
});

test('admin can see new user button', function () {
    asAdmin()
        ->get('/users')
        ->assertStatus(200)
        ->assertSee('New User');
});

test('admin can see user create page', function () {
    asAdmin()
        ->get('/users/create')
        ->assertStatus(200);
});

test('admin can create a new user', function () {
    $newUser = [
        'name' => 'User1',
        'email' => 'user1@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'user',
    ];

    asAdmin()
        ->post(route('users.store'), $newUser)
        ->assertStatus(302)
        ->assertRedirect(route('users.index'));

    $this->assertDatabaseHas('users', ['email' => $newUser['email']]);
});

test('admin can update user', function () {
    $simpleUser = User::factory()->simpleUser()->create();
    $updatingUserData = [
        'name' => 'Admin UPDATED',
        'role' => 'admin'
    ];

    asAdmin()
        ->put(route('users.update', $simpleUser), $updatingUserData)
        ->assertStatus(302)
        ->assertRedirect(route('users.edit', $simpleUser->id));

    $data = User::latest()->first();

    expect('Admin UPDATED')->toBe($data->name);
});

test('admin can delete a user', function () {
    $deletingUser = User::factory()->simpleUser()->create();

    asAdmin()
        ->from(route('users.index'))
        ->delete(route('users.destroy', $deletingUser))
        ->assertStatus(302)
        ->assertRedirect(route('users.index'));

    $this->assertSoftDeleted($deletingUser);
});




