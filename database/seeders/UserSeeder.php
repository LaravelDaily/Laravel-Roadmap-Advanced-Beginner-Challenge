<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(4)->create();

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@local.test',
        ]);

        $admin->assignRole(Role::first());
    }
}
