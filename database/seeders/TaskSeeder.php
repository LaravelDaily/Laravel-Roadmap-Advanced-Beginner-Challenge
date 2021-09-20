<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk(config('media-library.disk_name'))->deleteDirectory('Task');

        Task::factory()
            ->count(100)
            ->create();
    }
}
