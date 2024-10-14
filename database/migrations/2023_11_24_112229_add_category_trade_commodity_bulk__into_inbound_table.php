<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryTradeCommodityBulkIntoInboundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbounds', function (Blueprint $table) {

            $table->unsignedBigInteger('peb_type_id')->nullable();
            $table->unsignedBigInteger('export_category_id')->nullable();
            $table->unsignedBigInteger('trade_type_id')->nullable();
            $table->unsignedBigInteger('commodity_id')->nullable();
            $table->unsignedBigInteger('bulk_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inbounds', function (Blueprint $table) {
            $table->dropColumn('peb_type_id');
            $table->dropColumn('export_category_id');
            $table->dropColumn('trade_type_id');
            $table->dropColumn('commodity_id');
            $table->dropColumn('bulk_id');
        });
    }
}
