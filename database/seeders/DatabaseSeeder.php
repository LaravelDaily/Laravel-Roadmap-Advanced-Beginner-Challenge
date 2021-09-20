<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            ClientSeeder::class,
            ProjectSeeder::class,
            TaskSeeder::class,
            ResponseSeeder::class,
        ]);
    }
}
