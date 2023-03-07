<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@demo.com',
        ]);
        $clients = Client::factory(20)->create();
        User::factory(10)->has(
            Project::factory()->count(fake()->numberBetween(1, 5))
        )->has(
            Task::factory()->count(fake()->numberBetween(1, 5))
        )->create()->each(function ($user) use ($clients) {
            foreach($clients as $client){
                   $client->projects()->attach($user->projects()->get()->take(fake()->numberBetween(0, 20)));
            }
        });
    }
}
