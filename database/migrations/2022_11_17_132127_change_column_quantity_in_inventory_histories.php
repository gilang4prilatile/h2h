<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnQuantityInInventoryHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_histories', function (Blueprint $table) {
            $table->decimal('quantity', 30, 10)->change();
            $table->decimal('current_quantity', 30, 10)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_histories', function (Blueprint $table) {
            $table->bigInteger('quantity')->change();
            $table->bigInteger('current_quantity')->change();
        });
    }
}