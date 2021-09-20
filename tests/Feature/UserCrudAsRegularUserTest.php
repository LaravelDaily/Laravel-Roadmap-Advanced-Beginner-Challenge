<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudAsRegularUserTest extends TestCase
{

    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);

        $this->user = User::all()[1];
    }

    public function test_user_access_to_user_index()
    {
        $this->actingAs($this->user)
             ->from(route('dashboard'))
             ->get(route('user.index'))
             ->assertStatus(200)
             ->assertViewIs('user.index')
             ->assertViewHas('users');
    }

    public function test_user_unable_to_user_create()
    {
        $this->actingAs($this->user)
             ->from(route('user.index'))
             ->get(route('user.create'))
             ->assertStatus(403)
             ->assertDontSee('User create');
    }

    public function test_user_unable_to_user_store()
    {
        $this->actingAs($this->user)
             ->from(route('user.create'))
             ->post(route('user.store'), [
                 'name'                  => 'Test Name',
                 'email'                 => 'test@mail.com',
                 'password'              => 'testpass',
                 'password_confirmation' => 'testpass',
             ])
             ->assertStatus(403)
             ->assertSessionMissing('created');
    }

    public function test_user_unable_to_user_edit()
    {
        $userToUpdate = User::orderBy('id', 'DESC')->first();

        $this->actingAs($this->user)
             ->from(route('user.index'))
             ->get(route('user.edit', $userToUpdate->id))
             ->assertStatus(403)
             ->assertDontSee('User edit');
    }

    public function test_user_unable_to_user_update()
    {
        $userToUpdate = User::orderBy('id', 'DESC')->first();

        $this->actingAs($this->user)
             ->from(route('user.edit', $userToUpdate->id))
             ->put(route('user.update', $userToUpdate->id), [
                 'name'  => 'Updated Name',
                 'email' => 'updated@mail.com',
             ])
             ->assertStatus(403)
             ->assertSessionMissing('updated');

        $this->assertDatabaseMissing('users', [
            'id'    => $userToUpdate->id,
            'name'  => 'Updated Name',
            'email' => 'updated@mail.com',
        ]);

        $notUpdatedUser = User::orderBy('id', 'DESC')->first();

        $this->assertNotEquals('Updated Name', $notUpdatedUser->name);
    }

    public function test_user_unable_to_user_destroy()
    {
        $userToDelete = User::orderBy('id', 'DESC')->first();

        $this->actingAs($this->user)
             ->from(route('user.index'))
             ->delete(route('user.destroy', $userToDelete->id))
             ->assertStatus(403)
             ->assertSessionMissing('deleted');

        $this->assertDatabaseHas('users', [
            'id'         => $userToDelete->id,
            'deleted_at' => null,
        ]);
    }

    public function test_user_access_to_user_deleted()
    {
        $this->actingAs($this->user)
             ->from(route('user.index'))
             ->get(route('user.deleted'))
             ->assertStatus(200)
             ->assertViewIs('user.index')
             ->assertViewHas('users');
    }

    public function test_user_unable_to_user_restore()
    {
        User::orderBy('id', 'DESC')->first()->delete();
        $userDeleted = User::onlyTrashed()->first();

        $this->actingAs($this->user)
             ->from(route('user.deleted'))
             ->post(route('user.restore', $userDeleted->id))
             ->assertStatus(403)
             ->assertSessionMissing('restored');

        $this->assertDatabaseMissing('users', [
            'id'         => $userDeleted->id,
            'deleted_at' => null,
        ]);
    }

    public function test_user_unable_to_self_delete()
    {
        $this->actingAs($this->user)
             ->delete(route('user.destroy', $this->user->id))
             ->assertStatus(403);

        $this->assertDatabaseHas('users', [
            'id'         => $this->user->id,
            'deleted_at' => null,
        ]);
    }

    public function test_user_access_to_self_update()
    {
        $this->actingAs($this->user)
             ->from(route('user.edit', $this->user->id))
             ->put(route('user.update', $this->user->id), [
                 'name'  => 'Updated Name',
                 'email' => 'updated@mail.com',
             ])
             ->assertStatus(302)
             ->assertSessionHas('updated');

        $this->assertDatabaseHas('users', [
            'id'    => $this->user->id,
            'name'  => 'Updated Name',
            'email' => 'updated@mail.com',
        ]);

        $this->assertNotEquals('Updated Name', $this->user->name);
    }

    public function test_user_unable_to_self_assign_admin_role()
    {
        $this->actingAs($this->user)
             ->from(route('user.edit', $this->user->id))
             ->put(route('user.update', $this->user->id), [
                 'name'     => 'User 1',
                 'email'    => 'user1@mail.com',
                 'is_admin' => 1,
             ])
             ->assertStatus(302)
             ->assertRedirect(route('user.edit', $this->user->id))
             ->assertSessionHas('updated');

        $this->assertFalse($this->user->hasRole('admin'));
    }
}
