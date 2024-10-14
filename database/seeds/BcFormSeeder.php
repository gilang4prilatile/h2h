<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class BcFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("bc_forms")->insert([
            [
                "id" => 1,
                "name" => "BC40",
                "type" => "inbound"
            ],
            [
                "id" => 2,
                "name" => "BC41",
                "type" => "outbound"
            ],
            [
                "id" => 3,
                "name" => "BC23",
                "type" => "inbound"
            ],
            [
                "id" => 4,
                "name" => "BC25",
                "type" => "outbound"
            ],
            [
                "id" => 5,
                "name" => "BC27",
            ]
        ]);
    }
}
