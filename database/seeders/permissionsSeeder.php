<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class permissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permissions for project
        Permission::firstOrCreate([
            'name'=>'create project'
        ]);
        Permission::firstOrCreate([
            'name'=>'read project'
        ]);
        Permission::firstOrCreate([
            'name'=>'update project'
        ]);
        Permission::firstOrCreate([
            'name'=>'delete project'
        ]);
        //permissions for client
        Permission::firstOrCreate([
            'name'=>'create client'
        ]);
        Permission::firstOrCreate([
            'name'=>'update client'
        ]);
        Permission::firstOrCreate([
            'name'=>'read client'
        ]);
        Permission::firstOrCreate([
            'name'=>'delete client'
        ]);
        //task permissions
        Permission::firstOrCreate([
            'name'=>'create task'
        ]);
        Permission::firstOrCreate([
            'name'=>'update task'
        ]);
        Permission::firstOrCreate([
            'name'=>'read task'
        ]);
        Permission::firstOrCreate([
            'name'=>'delete task'
         ]);

        //normal user permissions
        Permission::firstOrCreate([
            'name'=>'edit profile image'
        ]);

        //adding permissions via role
        $admin=Role::where('name','admin')->first();
        $admin->givePermissionTo([
            'create project',
            'read project',
            'update project',
            'delete project',
            'create client',
            'update client',
            'read client',
            'delete client',
            'create task',
            'update task',
            'read task',
            'delete task'
        ]);
        //set normal user role permissions
        $normal_user=Role::where('name','normal_user')->first();
        $normal_user->givePermissionTo([
            'edit profile image'
        ]);




    }
}
