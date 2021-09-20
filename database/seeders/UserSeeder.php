<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'              => 'Admin',
                'email'             => 'admin@mail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('admin'),
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'User 1',
                'email'             => 'user1@mail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('user1'),
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'User 2',
                'email'             => 'user2@mail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('user2'),
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'User 3',
                'email'             => 'user3@mail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('user3'),
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);

        //User::factory()
        //    ->count(3)
        //    ->create();
    }
}
