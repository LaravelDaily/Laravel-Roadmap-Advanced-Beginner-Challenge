<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'show all user content']);

        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin'])->givePermissionTo(['manage users', 'delete', 'show all user content']);
    }
}
