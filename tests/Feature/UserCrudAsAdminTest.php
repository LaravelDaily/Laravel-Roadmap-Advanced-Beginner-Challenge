<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudAsAdminTest extends TestCase
{

    use RefreshDatabase;

    protected $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);

        $this->admin = User::first();
    }

    public function test_admin_access_to_user_index()
    {
        $this->actingAs($this->admin)
             ->from(route('dashboard'))
             ->get(route('user.index'))
             ->assertStatus(200)
             ->assertViewIs('user.index')
             ->assertViewHas('users');
    }

    public function test_admin_access_to_user_create()
    {
        $this->actingAs($this->admin)
             ->from(route('user.index'))
             ->get(route('user.create'))
             ->assertStatus(200)
             ->assertViewIs('user.create')
             ->assertSee('User create');
    }

    public function test_admin_access_to_user_store()
    {
        $this->actingAs($this->admin)
             ->from(route('user.create'))
             ->post(route('user.store'), [
                 'name'                  => 'Test Name',
                 'email'                 => 'test@mail.com',
                 'password'              => 'testpass',
                 'password_confirmation' => 'testpass',
             ])
             ->assertStatus(302)
             ->assertRedirect(route('user.index'))
             ->assertSessionHas('created');
    }

    public function test_admin_access_to_user_edit()
    {
        $userToUpdate = User::orderBy('id', 'DESC')->first();

        $this->actingAs($this->admin)
             ->from(route('user.index'))
             ->get(route('user.edit', $userToUpdate->id))
             ->assertStatus(200)
             ->assertViewIs('user.edit')
             ->assertViewHas('user')
             ->assertSee('User edit');
    }

    public function test_admin_access_to_user_update()
    {
        $userToUpdate = User::orderBy('id', 'DESC')->first();

        $this->actingAs($this->admin)
             ->from(route('user.edit', $userToUpdate->id))
             ->put(route('user.update', $userToUpdate->id), [
                 'name'  => 'Updated Name',
                 'email' => 'updated@mail.com',
             ])
             ->assertStatus(302)
             ->assertRedirect(route('user.edit', $userToUpdate->id))
             ->assertSessionHas('updated');

        $this->assertDatabaseHas('users', [
            'id'    => $userToUpdate->id,
            'name'  => 'Updated Name',
            'email' => 'updated@mail.com',
        ]);

        $updatedUser = User::orderBy('id', 'DESC')->first();

        $this->assertEquals('Updated Name', $updatedUser->name);
    }

    public function test_admin_access_to_user_destroy()
    {
        $userToDelete = User::orderBy('id', 'DESC')->first();

        $this->actingAs($this->admin)
             ->from(route('user.index'))
             ->delete(route('user.destroy', $userToDelete->id))
             ->assertStatus(302)
             ->assertRedirect(route('user.index'))
             ->assertSessionHas('deleted');

        $this->assertDatabaseMissing('users', [
            'id'         => $userToDelete->id,
            'deleted_at' => null,
        ]);
    }

    public function test_admin_access_to_user_deleted()
    {
        $this->actingAs($this->admin)
             ->from(route('user.index'))
             ->get(route('user.deleted'))
             ->assertStatus(200)
             ->assertViewIs('user.index')
             ->assertViewHas('users');
    }

    public function test_admin_access_to_user_restore()
    {
        User::orderBy('id', 'DESC')->first()->delete();
        $userDeleted = User::onlyTrashed()->first();

        $this->actingAs($this->admin)
             ->from(route('user.deleted'))
             ->post(route('user.restore', $userDeleted->id))
             ->assertStatus(302)
             ->assertRedirect(route('user.deleted'))
             ->assertSessionHas('restored');

        $this->assertDatabaseHas('users', [
            'id'         => $userDeleted->id,
            'deleted_at' => null,
        ]);
    }

    public function test_admin_unable_to_self_delete()
    {
        $this->actingAs($this->admin)
             ->delete(route('user.destroy', $this->admin->id))
             ->assertStatus(403);

        $this->assertDatabaseHas('users', [
            'id'         => $this->admin->id,
            'deleted_at' => null,
        ]);
    }

    public function test_admin_unable_to_delete_admin_role_from_first_admin()
    {
        $this->actingAs($this->admin)
             ->from(route('user.edit', $this->admin->id))
             ->put(route('user.update', $this->admin->id), [
                 'name'     => 'Admin',
                 'email'    => 'admin@mail.com',
                 'is_admin' => 0,
             ])
             ->assertStatus(302)
             ->assertRedirect(route('user.edit', $this->admin->id))
             ->assertSessionHas('updated');

        $this->assertTrue($this->admin->hasRole('admin'));
    }
}
