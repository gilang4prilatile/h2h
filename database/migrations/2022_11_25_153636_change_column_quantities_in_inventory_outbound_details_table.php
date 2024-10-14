<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnQuantitiesInInventoryOutboundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_outbound_details', function (Blueprint $table) {
            $table->decimal('quantity_outbound', 30, 10)->change();
            $table->decimal('quantity_good_conversion', 30, 10)->change();
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
            $table->bigInteger('quantity_outbound')->change();
            $table->bigInteger('quantity_good_conversion')->change();
        });
    }
}
