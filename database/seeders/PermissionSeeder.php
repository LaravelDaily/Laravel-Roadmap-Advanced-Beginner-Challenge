<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
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
        $permissions = [
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            'project_create',
            'project_edit',
            'project_show',
            'project_delete',
            'project_access',
            'task_create',
            'task_edit',
            'task_show',
            'task_delete',
            'task_access',
            'client_create',
            'client_edit',
            'client_show',
            'client_delete',
            'client_access',
        ];

        foreach ($permissions as $permission)   {
            Permission::create([
                'name' => $permission
            ]);
        }

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'Super Admin']);

        $role = Role::create(['name' => 'User']);

        $userPermissions = [
            'project_show',
            'project_access',
            'task_show',
            'task_access',
            'client_show',
            'client_access',
        ];

        foreach ($userPermissions as $permission)   {
            $role->givePermissionTo($permission);
        }
    }
}
