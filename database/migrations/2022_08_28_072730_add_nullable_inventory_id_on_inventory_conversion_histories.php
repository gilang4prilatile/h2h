<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableInventoryIdOnInventoryConversionHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_conversion_histories', function(Blueprint $table) {
            $table->unsignedBigInteger('inventory_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_conversion_histories', function(Blueprint $table) {
            $table->unsignedBigInteger('inventory_id')->change();
        });
    }
}
