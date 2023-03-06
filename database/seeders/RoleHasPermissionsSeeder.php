<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_has_permissions')->delete();
        DB::table('role_has_permissions')->insert([
                                   //role societe importateur avec  tous les permuissions

                  [
                    'role_id' => 1,
                    'permission_id' => 1
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 2
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 3
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 4
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 5
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 6
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 7
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 8
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 9
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 10
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 11
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 12
                  ],
                  //role societe importateur tous les permuissions

                  [
                    'role_id' => 1,
                    'permission_id' => 13
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 14
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 15
                  ],
                  [
                    'role_id' => 1,
                    'permission_id' => 16
                  ],
        ]);
    }
}
