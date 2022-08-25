<?php

namespace Database\Seeders;

use App\Models\Tasks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tasks::factory(60)->create();
        Tasks::factory()->count(10)
        ->state(['deleted_at' => now()->subDays(rand(1, 100))])
        ->create();
    }
}
