<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /*
         * admin setting
         */

        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'user']);

        $user=User::create(['name'=>'Admin',
            'email'=>'info@faxunil.hu',
            'password'=>Hash::make('1')
        ]);

        $user->assignRole('admin');

        $user=User::create(['name'=>'User',
            'email'=>'info@faxunil.hu',
            'password'=>Hash::make('1')
        ]);
        $user->assignRole('user');

        // \App\Models\User::factory(10)->create();
    }
}
