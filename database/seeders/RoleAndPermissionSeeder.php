<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    private $permissions = [
        'task-list',
        'project-list',
        'company-list',
        'client-list'

    ];
    private $adminPermissions = [
        'task-create',
        'task-edit',
        'task-delete',
        'project-create',
        'project-edit',
        'project-delete',
        'company-create',
        'company-edit',
        'company-delete',
        'client-create',
        'client-edit',
        'client-delete'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $this->command->info('Created:' . $adminRole);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $this->command->info('Created:' . $adminRole);
        $permissions = array_merge($this->adminPermissions, $this->permissions);
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $permissionIds = Permission::pluck('id', 'id')->all();
        $userPermissionsIds = Permission::whereIn('name', $this->permissions)->pluck('id', 'id')->all();

        $userRole->syncPermissions([$userPermissionsIds]);

        $adminRole->syncPermissions([$permissionIds]);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('Roles and permissions created!');
    }
}
