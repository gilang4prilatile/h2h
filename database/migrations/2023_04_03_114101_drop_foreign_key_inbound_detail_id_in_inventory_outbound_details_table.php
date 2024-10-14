<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeyInboundDetailIdInInventoryOutboundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_outbound_details', function (Blueprint $table) {
            $table->dropForeign(['inbound_detail_id']);
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
            $table->foreignId('inbound_detail_id')->constrained();
        });
    }
}
