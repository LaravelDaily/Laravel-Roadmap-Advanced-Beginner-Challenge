<?php

namespace Database\Seeders;

use App\Models\Clients;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class ClientsSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clients::factory()->count(20)->create();
        Clients::factory()->count(10)
        ->state(['deleted_at' => now()->subDays(rand(1, 100))])
        ->create();
    }
}
