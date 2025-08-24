<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TaskSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
