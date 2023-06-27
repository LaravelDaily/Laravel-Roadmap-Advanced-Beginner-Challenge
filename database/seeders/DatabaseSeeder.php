<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ClientFactory;
use Database\Factories\ProjectFactory;
use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         UserFactory::new()->count(5)->create();

         ClientFactory::new()->count(10)->create();

         ProjectFactory::new()->count(10)->create();

         TaskFactory::new()->count(10)->create();
    }
}
