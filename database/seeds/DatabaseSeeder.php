<?php

use App\Models\BcForm;
use App\Models\Status;
use App\Models\TransportLine;
use Database\Seeders\BcFormSeeder;
use Database\Seeders\MasterTypeGoodSeeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\StatusSeeder;
use Database\Seeders\TransportationSeeder;
use Database\Seeders\TransportLineSeeder;
use Database\Seeders\TypeGoodSeeder;
use InitSeeder as Initial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* $this->call(Initial::class); */
        /* $this->call(BcFormSeeder::class); */
        /* $this->call(StatusSeeder::class); */
        /* $this->call(TransportLineSeeder::class); */
        /* $this->call(TransportationSeeder::class); */
        $this->call([
            PermissionSeeder::class
        ]);
    }
}
