<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnQuantityGoodsInInventoryConversionHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_conversion_histories', function (Blueprint $table) {
            $table->decimal('quantity_good', 30,10)->after('current_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_conversion_histories', function (Blueprint $table) {
            $table->dropColumn('quantity_goods');
        });
    }
}
