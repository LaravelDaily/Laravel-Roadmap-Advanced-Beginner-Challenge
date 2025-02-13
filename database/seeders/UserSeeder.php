<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
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
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create admin User and assign the role to him.
        $adminuser = User::create([
            'first_name' => 'Marko',
            'last_name' => 'Milicevic',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'email_verified_at' => Carbon::now(),
        ]);

        $users = User::factory(20)->create();

        $adminuser->assignRole('admin');

        foreach ($users as $user) {
            $user->assignRole('user');
        }
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('Users created together with roles and permissions!');
    }
}
