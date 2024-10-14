<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("transportations")->insert([
            [
                "id" => 1,
                "code" => 1,
                "transport_line_id" => 1,
                "name" => "Kapal"
            ],
            [
                "id" => 2,
                "code" => 2,
                "transport_line_id" => 2,
                "name" => "Pesawat"
            ],
            [
                "id" => 3,
                "code" => 3,
                "transport_line_id" => 3,
                "name" => "Truk"
            ]
        ]);
    }
}
