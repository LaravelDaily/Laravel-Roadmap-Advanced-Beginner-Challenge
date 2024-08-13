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
    $admin = User::factory()->admin()->create();

    actingAs($admin)
        ->get('/users')
        ->assertStatus(200);
});

test('manager cannot see user page', function () {
    $manager = User::factory()->manager()->create();

    actingAs($manager)
        ->get('/users')
        ->assertStatus(403);
});

test('simple user cannot see user page', function () {
    $simpleUser = User::factory()->simpleUser()->create();

    actingAs($simpleUser)
        ->get('/users')
        ->assertStatus(403);
});

test('user page contains user data', function () {
    $admin = User::factory()->admin()->create();
    $users = User::factory()->create();
    actingAs($admin)
        ->get('/users')
        ->assertStatus(200)
        ->assertViewHas('users', function (LengthAwarePaginator $collection) use ($users) {
            return $collection->contains($users);
        });
});

test('admin can see new user button', function () {
    $admin = User::factory()->admin()->create();

    actingAs($admin)
        ->get('/users')
        ->assertStatus(200)
        ->assertSee('New User');
});

test('admin can see user create page', function () {
    $admin = User::factory()->admin()->create();

    actingAs($admin)
        ->get('/users/create')
        ->assertStatus(200);
});

test('admin can create a new user', function () {
    $admin = User::factory()->admin()->create();
    $newUser = [
        'name' => 'User1',
        'email' => 'user1@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'user',
    ];

    actingAs($admin)
        ->post(route('users.store'), $newUser)
        ->assertStatus(302)
        ->assertRedirect(route('users.index'));

    $this->assertDatabaseHas('users', ['email' => $newUser['email']]);
});

test('admin can update user', function () {
    $admin = User::factory()->admin()->create();
    $updatingUserData = [
        'name' => 'Admin UPDATED',
        'role' => 'admin'
    ];

    actingAs($admin)
        ->put(route('users.update', $admin), $updatingUserData)
        ->assertStatus(302)
        ->assertRedirect(route('users.edit', $admin->id));

    $data = User::latest()->first();

    expect('Admin UPDATED')->toBe($data->name);
});

test('admin can delete a user', function () {
    $admin = User::factory()->admin()->create();
    $deletingUser = User::factory()->simpleUser()->create();

    actingAs($admin)
        ->from(route('users.index'))
        ->delete(route('users.destroy', $deletingUser))
        ->assertStatus(302)
        ->assertRedirect(route('users.index'));

    $this->assertSoftDeleted($deletingUser);
});




