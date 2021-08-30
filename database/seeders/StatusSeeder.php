<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            [
                'state' => 'Pending'
            ],
            [
                'state' => 'In process'
            ],
            [
                'state' => 'Review'
            ],
            [
                'state' => 'Closed'
            ]
        ]);
    }
}
