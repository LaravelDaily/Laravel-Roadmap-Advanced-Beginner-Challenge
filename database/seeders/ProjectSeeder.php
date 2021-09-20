<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk(config('media-library.disk_name'))->deleteDirectory('Project');

        Project::factory()
               ->count(25)
               ->create();
    }
}
