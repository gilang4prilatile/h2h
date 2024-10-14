<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("statuses")->insert([
            [
                "id" => 1,
                "bc_form_id" => 1,
                "name" => "DRAFT",
            ],
            [
                "id" => 2,
                "bc_form_id" => 2,
                "name" => "DRAFT",
            ],
            [
                "id" => 3,
                "bc_form_id" => 3,
                "name" => "DRAFT",
            ],
            [
                "id" => 4,
                "bc_form_id" => 4,
                "name" => "DRAFT",
            ],
            [
                "id" => 5,
                "bc_form_id" => 1,
                "name" => "DONE",
            ],
            [
                "id" => 6,
                "bc_form_id" => 2,
                "name" => "DONE",
            ],
            [
                "id" => 7,
                "bc_form_id" => 3,
                "name" => "DONE",
            ],
            [
                "id" => 8,
                "bc_form_id" => 4,
                "name" => "DONE",
            ],
            [
                "id" => 9,
                "bc_form_id" => 5,
                "name" => "DRAFT",
            ],
            [
                "id" => 10,
                "bc_form_id" => 5,
                "name" => "DONE",
            ]
        ]);
    }
}
