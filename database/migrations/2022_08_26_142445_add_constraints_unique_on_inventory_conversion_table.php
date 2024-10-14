<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintsUniqueOnInventoryConversionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_conversions', function (Blueprint $table) {
            $table->unique(['good_id', 'bc_form_id']);
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
            $table->dropUnique(['good_id', 'bc_form_id']);
        });
    }
}
