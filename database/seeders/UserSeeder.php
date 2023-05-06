<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(7);

        // use spatie permissions package
       Role::firstOrCreate(['id' => 1, 'name' => 'admin', 'guard_name' => 'web']);
       Role::firstOrCreate(['id' => 2, 'name' => 'normal_user', 'guard_name' => 'web']);

        //admin
        $admin=User::factory()->create([
            'name'=>'admin',
            'password'=> bcrypt('adminadmin')
        ]);
        $admin->assignRole('admin');
        //normal user
        $normal_user=User::factory()->create([
            'name'=>'normal user',
            'password'=> bcrypt('adminadmin')

        ]);
        $normal_user->assignRole('normal_user');


    }
}
