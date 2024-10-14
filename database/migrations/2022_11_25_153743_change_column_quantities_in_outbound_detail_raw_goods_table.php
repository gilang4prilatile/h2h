<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnQuantitiesInOutboundDetailRawGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outbound_detail_raw_goods', function (Blueprint $table) {
            $table->decimal('quantity', 30, 10)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outbound_detail_raw_goods', function (Blueprint $table) {
            $table->bigInteger('quantity')->change();
        });
    }
}
