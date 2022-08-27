<?php

namespace Database\Seeders;

use App\Models\Projects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Projects::factory()->count(20)->create();
        Projects::factory()->count(10)
        ->state(['deleted_at' => now()->subDays(rand(1, 100))])
        ->create();
    }
}
