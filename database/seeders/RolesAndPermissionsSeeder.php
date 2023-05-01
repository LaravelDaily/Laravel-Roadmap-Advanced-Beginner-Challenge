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

        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'show users']);
        Permission::create(['name' => 'delete users']);

        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin'])->givePermissionTo(['edit users', 'show users', 'delete users']);
    }
}
