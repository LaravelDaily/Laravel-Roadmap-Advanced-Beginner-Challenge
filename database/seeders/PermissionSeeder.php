<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'users',
            'clients',
            'projects',
            'tasks',
        ];

        foreach($permissions as $permission) {
            Permission::create(['name' => 'access '.$permission]);
            Permission::create(['name' => 'edit '.$permission]);
            Permission::create(['name' => 'create '.$permission ]);
            Permission::create(['name' => 'delete '.$permission]);
        }
    }
}
