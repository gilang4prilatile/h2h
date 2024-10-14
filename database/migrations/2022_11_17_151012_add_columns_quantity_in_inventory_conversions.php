<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsQuantityInInventoryConversions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_conversions', function (Blueprint $table) {
            $table->decimal('total_outbound', 30, 10)->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_conversions', function (Blueprint $table) {
            $table->dropColumn('total_outbound');
        });
    }
}
