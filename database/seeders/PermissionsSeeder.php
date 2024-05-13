<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        app()[PermissionRegistrar::class]->forgetCachedPermissions();
//
//        // create permissions
//        Permission::create(['name' => 'edit articles']);
//        Permission::create(['name' => 'delete articles']);
//        Permission::create(['name' => 'publish articles']);
//        Permission::create(['name' => 'unpublish articles']);
//
//        // create roles and assign existing permissions
//        $role1 = Role::create(['name' => 'writer']);
//        $role1->givePermissionTo('edit articles');
//        $role1->givePermissionTo('delete articles');
//
//        $role2 = Role::create(['name' => 'admin']);
//        $role2->givePermissionTo('publish articles');
//        $role2->givePermissionTo('unpublish articles');
//
//        $role3 = Role::create(['name' => 'Super-Admin']);
//        // gets all permissions via Gate::before rule; see AuthServiceProvider
//
//        // create demo users
//        $user = \App\Models\User::factory()->create([
//            'name' => 'Example User',
//            'email' => 'test@example.com',
//        ]);
//        $user->assignRole($role1);
//
//        $user = \App\Models\User::factory()->create([
//            'name' => 'Example Admin User',
//            'email' => 'admin@example.com',
//        ]);
//        $user->assignRole($role2);
//
//        $user = \App\Models\User::factory()->create([
//            'name' => 'Example Super-Admin User',
//            'email' => 'superadmin@example.com',
//        ]);
//        $user->assignRole($role3);
    }
}
