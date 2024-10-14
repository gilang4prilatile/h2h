<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeInInventoryHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('inventory_histories', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('inventory_histories', function (Blueprint $table) {
            $table->enum('type', ['inbound', 'outbound', 'converted', 'stock in', 'stock out']);
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
            $table->dropColumn('type');
        });

        Schema::table('inventory_histories', function (Blueprint $table) {
            $table->enum('type', ['inbound', 'outbound', 'converted']);
        });
    }
}
