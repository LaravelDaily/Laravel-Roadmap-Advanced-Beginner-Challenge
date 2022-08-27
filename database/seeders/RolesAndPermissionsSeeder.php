<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        // array permissons
        $permissions = 
                ['list-project', 'show-project', 'create-project', 'edit-project'
                , 'delete-project', 'list-task' , 'show-task', 'create-task', 'edit-task'
                , 'delete-task', 'list-client', 'show-client', 'create-client', 'edit-client'
                , 'delete-client', 
                ];
        // loop permissons
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        Permission::create(['name' => 'list-user']);
        Permission::create(['name' => 'show-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);
        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo($permissions);
    }
}
