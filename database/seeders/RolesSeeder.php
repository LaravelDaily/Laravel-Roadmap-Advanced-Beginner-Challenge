<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('roles')->delete();
      DB::table('roles')->insert([
         [
            'id' => 1,
            'name' => 'Admin',
            'guard_name' => 'web'
         ],
         [
            'id' => 2,
            'name' => 'Client',
            'guard_name' => 'web'
         ],
         [
            'id' => 3,
            'name' => 'Tasker',
            'guard_name' => 'web'
         ],
      ]);
   }
}
