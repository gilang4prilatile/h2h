<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TransportLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("transport_lines")->insert([
            [
                "id" => 1,
                "code" => 1,
                "name" => "Laut"
            ],
            [
                "id" => 2,
                "code" => 2,
                "name" => "Udara"
            ],
            [
                "id" => 3,
                "code" => 3,
                "name" => "Darat"
            ]
        ]);
    }
}
