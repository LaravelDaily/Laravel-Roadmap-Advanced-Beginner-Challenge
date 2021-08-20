<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'user']);

        $user=User::create(['name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('1')
        ]);

        $user->assignRole('admin','user');
        $user->update(['name'=>$user->name.' Token: '.$user->createToken('api')->plainTextToken]);


        $user=User::create(['name'=>'User',
            'email'=>'user@admin.com',
            'password'=>Hash::make('1')
        ]);
        $user->assignRole('user');
        $user->update(['name'=>$user->name.' Token: '.$user->createToken('api')->plainTextToken]);


        User::factory()->times(15)->create();
        // create 2 more random admin and 5 users roles,
        //10 user dont have any role
        $i=2;
        while($i<6) {
            $i++;
            if ($user=User::find($i)) {
                $user->assignRole('user');
                if ($i<5) {
                    $user->assignRole('admin');
                }
            }
        }
    }
}
