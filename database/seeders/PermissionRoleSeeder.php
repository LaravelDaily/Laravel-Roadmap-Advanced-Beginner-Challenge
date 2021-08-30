<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'create clients']);
        Permission::create(['name' => 'read clients']);
        Permission::create(['name' => 'update clients']);
        Permission::create(['name' => 'delete clients']);

        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'read projects']);
        Permission::create(['name' => 'update projects']);
        Permission::create(['name' => 'delete projects']);

        Permission::create(['name' => 'create tasks']);
        Permission::create(['name' => 'read tasks']);
        Permission::create(['name' => 'update tasks']);
        Permission::create(['name' => 'delete tasks']);

        // create roles and assign existing permissions
        $admin = Role::create(['name' => 'admin']);

        $admin->givePermissionTo('create users');
        $admin->givePermissionTo('read users');
        $admin->givePermissionTo('update users');
        $admin->givePermissionTo('delete users');

        $admin->givePermissionTo('create clients');
        $admin->givePermissionTo('read clients');
        $admin->givePermissionTo('update clients');
        $admin->givePermissionTo('delete clients');

        $admin->givePermissionTo('create projects');
        $admin->givePermissionTo('read projects');
        $admin->givePermissionTo('update projects');
        $admin->givePermissionTo('delete projects');

        $admin->givePermissionTo('create tasks');
        $admin->givePermissionTo('read tasks');
        $admin->givePermissionTo('update tasks');
        $admin->givePermissionTo('delete tasks');

        $userRole = Role::create(['name' => 'user']);

        $userRole->givePermissionTo('read users');

        $userRole->givePermissionTo('read clients');

        $userRole->givePermissionTo('read projects');
        $userRole->givePermissionTo('update projects');

        $userRole->givePermissionTo('create tasks');
        $userRole->givePermissionTo('read tasks');
        $userRole->givePermissionTo('update tasks');
        $userRole->givePermissionTo('delete tasks');

        $superAdmin = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'user@example.com',
        ]);
        $user->assignRole($userRole);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($admin);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($superAdmin);
    }
}
