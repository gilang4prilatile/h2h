<?php

namespace Database\Seeders;

use App\Models\MasterTypeGoods;
use Illuminate\Database\Seeder;

class MasterTypeGoodSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterTypeGoods::updateOrCreate(
            [
                "code" => "ATK" ,
                "name" => "ATK"
            ]
        );
        MasterTypeGoods::updateOrCreate(
            [
                "code" => "BK" ,
                "name" => "Baku"
            ]
        );
        MasterTypeGoods::updateOrCreate(
            [
                "code" => "KMI" ,
                "name" => "Kimia"
            ]
        );
        MasterTypeGoods::updateOrCreate(
            [
                "code" => "PG" ,
                "name" => "Pengemas"
            ]
        );
        MasterTypeGoods::updateOrCreate(
            [
                "code" => "PN" ,
                "name" => "Penolong"
            ]
        );
        MasterTypeGoods::updateOrCreate(
            [
                "code" => "SPRT" ,
                "name" => "Sparepart"
            ]
        );
    }
}
