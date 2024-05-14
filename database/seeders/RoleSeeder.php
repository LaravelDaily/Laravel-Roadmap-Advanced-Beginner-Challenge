<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $userRole = Role::create(['name' => 'user']);

        $adminPermissions = Permission::select('name')->get()->toArray();
        $adminRole->givePermissionTo($adminPermissions);
        $userRole->givePermissionTo([
            'access tasks',
            'edit tasks'
        ]);
        $managerRole->givePermissionTo([
            'access clients',
            'edit clients',
            'create clients',
            'delete clients',
            'access projects',
            'edit projects',
            'create projects',
            'delete projects',
            'access tasks',
            'edit tasks',
            'create tasks',
            'delete tasks',
        ]);
    }
}
