<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->delete();
        DB::table('model_has_roles')->insert([
                 [
                    'role_id' => 1,
                    'model_type' => 'user',
                    'model_id' => 1
                 ],
        ]);
    }
}
