<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInventoryConversionIdInInventoryOutboundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_outbound_details', function (Blueprint $table) {
            $table->bigInteger("inventory_conversion_id")->after('inventory_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_outbound_details', function (Blueprint $table) {
            $table->dropColumn('inventory_conversion_id');
        });
    }
}
