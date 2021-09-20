<?php

namespace Database\Seeders;

use App\Models\Response;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk(config('media-library.disk_name'))->deleteDirectory('Response');

        Response::factory()
                ->count(400)
                ->create();
    }
}
