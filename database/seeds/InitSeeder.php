<?php

use App\Models\MasterClient;
use App\User;
use App\Models\Warehouse;
use App\Models\MasterKppbc;
use App\Models\MasterValas;
use Illuminate\Database\Seeder;
use App\Models\MasterPengangkutan;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\MasterSaranaPengangkut;
use Spatie\Permission\Models\Permission;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            "name" => "Super Admin",
            "email" => "super@store2go.com",
            "password" => Hash::make('admin123'),
        ]);

        $permissions = Permission::all();
        $roleSuperAdmin = Role::create([
            "name" => "Super Admin"
        ]);

        foreach ($permissions as $permission) {
            $roleSuperAdmin->givePermissionTo($permission);
        }

        $superAdmin->assignRole($roleSuperAdmin);

        $warehouses = [
            [
                "code" => "W01",
                "name" => "Warehouse One"
            ],
            [
                "code" => "W02",
                "name" => "Warehouse Two"
            ],
            [
                "code" => "W03",
                "name" => "Warehouse Three"
            ]
        ];

        Warehouse::insert($warehouses);

        DB::table("master_kppbc")->insert([
            "code" => "040300",
            "description" => "KPU TANJUNG PRIOK",
        ]);

        DB::table("master_kppbc")->insert([
            "code" => "160200",
            "description" => "KPPBC MARUNDA",
        ]);

        DB::table('countries')->insert([
            "code" => "ID",
            "name" => "Indonesia"
        ]);

        DB::table('countries')->insert([
            "code" => "SG",
            "name" => "Singapore"
        ]);

        $tujuanPengiriman = [
            "Disubkontrakan",
            "Dipinjamkan",
            "Diperbaiki",
            "Dipamerkan",
            "Lainnya",
        ];

        foreach ($tujuanPengiriman as $tp) {
            DB::table('master_tujuan_pengiriman')
                ->insert([
                    "code" => strtoupper(Str::random(3)),
                    "name" => $tp,
                    "created_by" => 1,
                ]);
        }

        DB::table("master_packages")->insert([
            "code" => "PST",
            "name" => "Plastik",
            "created_by" => 1,
        ]);

        DB::table("master_packages")->insert([
            "code" => "KRD",
            "name" => "Kardus",
            "created_by" => 1,
        ]);

        DB::table("master_uom")->insert([
            "code" => "KG",
            "name" => "Kilogram",
        ]);

        DB::table("master_uom")->insert([
            "code" => "L",
            "name" => "Liter",
        ]);

        $documents = [
            "Packing List",
            "Kontrak",
            "Faktur Pajak",
            "SKEP"
        ];

        foreach ($documents as $d) {
            DB::table("master_documents")
                ->insert([
                    "code" => Str::random(3),
                    "name" => $d,
                ]);
        }

        MasterValas::insert(
            [
                "code" => "IDR",
                "name" => "Indonesia Rupiah"
            ],

        );
    }
}
