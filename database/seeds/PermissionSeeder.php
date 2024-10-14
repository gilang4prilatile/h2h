<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::updateOrCreate(["name" => "view master-data country"]);
        Permission::updateOrCreate(["name" => "create master-data country"]);
        Permission::updateOrCreate(["name" => "edit master-data country"]);
        Permission::updateOrCreate(["name" => "delete master-data country"]);

        Permission::updateOrCreate(["name" => "view master-data uom"]);
        Permission::updateOrCreate(["name" => "create master-data uom"]);
        Permission::updateOrCreate(["name" => "edit master-data uom"]);
        Permission::updateOrCreate(["name" => "delete master-data uom"]);

        Permission::updateOrCreate(["name" => "view master-data kppbc"]);
        Permission::updateOrCreate(["name" => "create master-data kppbc"]);
        Permission::updateOrCreate(["name" => "edit master-data kppbc"]);
        Permission::updateOrCreate(["name" => "delete master-data kppbc"]);

        Permission::updateOrCreate(["name" => "view master-data profile"]);
        Permission::updateOrCreate(["name" => "create master-data profile"]);
        Permission::updateOrCreate(["name" => "edit master-data profile"]);
        Permission::updateOrCreate(["name" => "delete master-data profile"]);

        Permission::updateOrCreate(["name" => "view master-data hscode"]);
        Permission::updateOrCreate(["name" => "create master-data hscode"]);
        Permission::updateOrCreate(["name" => "edit master-data hscode"]);
        Permission::updateOrCreate(["name" => "delete master-data hscode"]);

        Permission::updateOrCreate(["name" => "view master-data rate-preference"]);
        Permission::updateOrCreate(["name" => "create master-data rate-preference"]);
        Permission::updateOrCreate(["name" => "edit master-data rate-preference"]);
        Permission::updateOrCreate(["name" => "delete master-data rate-preference"]);

        Permission::updateOrCreate(["name" => "view master-data tujuan-pengiriman"]);
        Permission::updateOrCreate(["name" => "create master-data tujuan-pengiriman"]);
        Permission::updateOrCreate(["name" => "edit master-data tujuan-pengiriman"]);
        Permission::updateOrCreate(["name" => "delete master-data tujuan-pengiriman"]);

        Permission::updateOrCreate(["name" => "view master-data jenis-tpb"]);
        Permission::updateOrCreate(["name" => "create master-data jenis-tpb"]);
        Permission::updateOrCreate(["name" => "edit master-data jenis-tpb"]);
        Permission::updateOrCreate(["name" => "delete master-data jenis-tpb"]);

        Permission::updateOrCreate(["name" => "view master-data package"]);
        Permission::updateOrCreate(["name" => "create master-data package"]);
        Permission::updateOrCreate(["name" => "edit master-data package"]);
        Permission::updateOrCreate(["name" => "delete master-data package"]);

        Permission::updateOrCreate(["name" => "view master-data document"]);
        Permission::updateOrCreate(["name" => "create master-data document"]);
        Permission::updateOrCreate(["name" => "edit master-data document"]);
        Permission::updateOrCreate(["name" => "delete master-data document"]);

        Permission::updateOrCreate(["name" => "view master-data tps"]);
        Permission::updateOrCreate(["name" => "create master-data tps"]);
        Permission::updateOrCreate(["name" => "edit master-data tps"]);
        Permission::updateOrCreate(["name" => "delete master-data tps"]);

        Permission::updateOrCreate(["name" => "view master-data warehouse"]);
        Permission::updateOrCreate(["name" => "create master-data warehouse"]);
        Permission::updateOrCreate(["name" => "edit master-data warehouse"]);
        Permission::updateOrCreate(["name" => "delete master-data warehouse"]);

        Permission::updateOrCreate(["name" => "view master-data ukuran-peti-kemas"]);
        Permission::updateOrCreate(["name" => "create master-data ukuran-peti-kemas"]);
        Permission::updateOrCreate(["name" => "edit master-data ukuran-peti-kemas"]);
        Permission::updateOrCreate(["name" => "delete master-data ukuran-peti-kemas"]);

        Permission::updateOrCreate(["name" => "view master-data type-peti-kemas"]);
        Permission::updateOrCreate(["name" => "create master-data type-peti-kemas"]);
        Permission::updateOrCreate(["name" => "edit master-data type-peti-kemas"]);
        Permission::updateOrCreate(["name" => "delete master-data type-peti-kemas"]);

        Permission::updateOrCreate(["name" => "view master-data valas"]);
        Permission::updateOrCreate(["name" => "create master-data valas"]);
        Permission::updateOrCreate(["name" => "edit master-data valas"]);
        Permission::updateOrCreate(["name" => "delete master-data valas"]);

        Permission::updateOrCreate(["name" => "view master-data goods"]);
        Permission::updateOrCreate(["name" => "create master-data goods"]);
        Permission::updateOrCreate(["name" => "edit master-data goods"]);
        Permission::updateOrCreate(["name" => "delete master-data goods"]);

        Permission::updateOrCreate(["name" => "view master-data good-conversion"]);
        Permission::updateOrCreate(["name" => "create master-data good-conversion"]);
        Permission::updateOrCreate(["name" => "edit master-data good-conversion"]);
        Permission::updateOrCreate(["name" => "delete master-data good-conversion"]);

        Permission::updateOrCreate(["name" => "view master-data type-goods"]);
        Permission::updateOrCreate(["name" => "create master-data type-goods"]);
        Permission::updateOrCreate(["name" => "edit master-data type-goods"]);
        Permission::updateOrCreate(["name" => "delete master-data type-goods"]);
    
        Permission::updateOrCreate(["name" => "view master-data port"]);
        Permission::updateOrCreate(["name" => "create master-data port"]);
        Permission::updateOrCreate(["name" => "edit master-data port"]);
        Permission::updateOrCreate(["name" => "delete master-data port"]);

        Permission::updateOrCreate(["name" => "view inventory"]);
        Permission::updateOrCreate(["name" => "create inventory"]);
        Permission::updateOrCreate(["name" => "edit inventory"]);
        Permission::updateOrCreate(["name" => "delete inventory"]);

        Permission::updateOrCreate(["name" => "view inventory-out"]);
        Permission::updateOrCreate(["name" => "create inventory-out"]);
        Permission::updateOrCreate(["name" => "edit inventory-out"]);
        Permission::updateOrCreate(["name" => "delete inventory-out"]);

        Permission::updateOrCreate(["name" => "view inventory-conversion"]);
        Permission::updateOrCreate(["name" => "create inventory-conversion"]);
        Permission::updateOrCreate(["name" => "edit inventory-conversion"]);
        Permission::updateOrCreate(["name" => "delete inventory-conversion"]);

        Permission::updateOrCreate(["name" => "view inventory-conversion-out"]);
        Permission::updateOrCreate(["name" => "create inventory-conversion-out"]);
        Permission::updateOrCreate(["name" => "edit inventory-conversion-out"]);
        Permission::updateOrCreate(["name" => "delete inventory-conversion-out"]);

        Permission::updateOrCreate(["name" => "view inbound bc-40"]);
        Permission::updateOrCreate(["name" => "create inbound bc-40"]);
        Permission::updateOrCreate(["name" => "edit inbound bc-40"]);
        Permission::updateOrCreate(["name" => "delete inbound bc-40"]);

        Permission::updateOrCreate(["name" => "view inbound bc-23"]);
        Permission::updateOrCreate(["name" => "create inbound bc-23"]);
        Permission::updateOrCreate(["name" => "edit inbound bc-23"]);
        Permission::updateOrCreate(["name" => "delete inbound bc-23"]);

        Permission::updateOrCreate(["name" => "view inbound bc-27"]);
        Permission::updateOrCreate(["name" => "create inbound bc-27"]);
        Permission::updateOrCreate(["name" => "edit inbound bc-27"]);
        Permission::updateOrCreate(["name" => "delete inbound bc-27"]);

        Permission::updateOrCreate(["name" => "view outbound bc-41"]);
        Permission::updateOrCreate(["name" => "create outbound bc-41"]);
        Permission::updateOrCreate(["name" => "edit outbound bc-41"]);
        Permission::updateOrCreate(["name" => "delete outbound bc-41"]);

        Permission::updateOrCreate(["name" => "view outbound bc-25"]);
        Permission::updateOrCreate(["name" => "create outbound bc-25"]);
        Permission::updateOrCreate(["name" => "edit outbound bc-25"]);
        Permission::updateOrCreate(["name" => "delete outbound bc-25"]);

        Permission::updateOrCreate(["name" => "view outbound bc-27"]);
        Permission::updateOrCreate(["name" => "create outbound bc-27"]);
        Permission::updateOrCreate(["name" => "edit outbound bc-27"]);
        Permission::updateOrCreate(["name" => "delete outbound bc-27"]);

        Permission::updateOrCreate(["name" => "view ocean pib"]);
        Permission::updateOrCreate(["name" => "create ocean pib"]);
        Permission::updateOrCreate(["name" => "edit ocean pib"]);
        Permission::updateOrCreate(["name" => "delete ocean pib"]);

        Permission::updateOrCreate(["name" => "view air pib"]);
        Permission::updateOrCreate(["name" => "create air pib"]);
        Permission::updateOrCreate(["name" => "edit air pib"]);
        Permission::updateOrCreate(["name" => "delete air pib"]);

        Permission::updateOrCreate(["name" => "view ocean peb"]);
        Permission::updateOrCreate(["name" => "create ocean peb"]);
        Permission::updateOrCreate(["name" => "edit ocean peb"]);
        Permission::updateOrCreate(["name" => "delete ocean peb"]);

        Permission::updateOrCreate(["name" => "view air peb"]);
        Permission::updateOrCreate(["name" => "create air peb"]);
        Permission::updateOrCreate(["name" => "edit air peb"]);
        Permission::updateOrCreate(["name" => "delete air peb"]);
        
        Permission::updateOrCreate(["name" => "view ftz import-from-outside-pabean"]);
        Permission::updateOrCreate(["name" => "create ftz import-from-outside-pabean"]);
        Permission::updateOrCreate(["name" => "edit ftz import-from-outside-abean"]);
        Permission::updateOrCreate(["name" => "delete ftz import-from-outside-pabean"]);

        Permission::updateOrCreate(["name" => "view ftz export-to-outside-pabean"]);
        Permission::updateOrCreate(["name" => "create ftz export-to-outside-pabean"]);
        Permission::updateOrCreate(["name" => "edit ftz export-to-outside-pabean"]);
        Permission::updateOrCreate(["name" => "delete ftz export-to-outside-pabean"]);

        Permission::updateOrCreate(["name" => "view user-administration user"]);
        Permission::updateOrCreate(["name" => "create user-administration user"]);
        Permission::updateOrCreate(["name" => "edit user-administration user"]);
        Permission::updateOrCreate(["name" => "delete user-administration user"]);

        Permission::updateOrCreate(["name" => "view user-administration role"]);
        Permission::updateOrCreate(["name" => "create user-administration role"]);
        Permission::updateOrCreate(["name" => "edit user-administration role"]);
        Permission::updateOrCreate(["name" => "delete user-administration role"]);
    }
}
