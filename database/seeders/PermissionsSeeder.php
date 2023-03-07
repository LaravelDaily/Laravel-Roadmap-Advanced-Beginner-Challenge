<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'view_users',
                'guard_name' => 'web'
            ],
            [
                'id' => 2,
                'name' => 'create_users',
                'guard_name' => 'web'
            ],
            [
                'id' => 3,
                'name' => 'edit_users',
                'guard_name' => 'web'
            ],
            [
                'id' => 4,
                'name' => 'delete_users',
                'guard_name' => 'web'
            ],    
            [
                'id' => 5,
                'name' => 'view_projects',
                'guard_name' => 'web'
            ],
            [
                'id' => 6,
                'name' => 'create_projects',
                'guard_name' => 'web'
            ],
            [
                'id' => 7,
                'name' => 'edit_projects',
                'guard_name' => 'web'
            ],
            [
                'id' => 8,
                'name' => 'delete_projects',
                'guard_name' => 'web'
            ],    
            [
                'id' => 9,
                'name' => 'view_clients',
                'guard_name' => 'web'
            ],
            [
                'id' => 10,
                'name' => 'create_clients',
                'guard_name' => 'web'
            ],
            [
                'id' => 11,
                'name' => 'edit_clients',
                'guard_name' => 'web'
            ],
            [
                'id' => 12,
                'name' => 'delete_clients',
                'guard_name' => 'web'
            ],    
            [
                'id' => 13,
                'name' => 'view_tasks',
                'guard_name' => 'web'
            ],
            [
                'id' => 14,
                'name' => 'create_tasks',
                'guard_name' => 'web'
            ],
            [
                'id' => 15,
                'name' => 'edit_tasks',
                'guard_name' => 'web'
            ],
            [
                'id' => 16,
                'name' => 'delete_tasks',
                'guard_name' => 'web'
            ],    
        ]);
    }
}
