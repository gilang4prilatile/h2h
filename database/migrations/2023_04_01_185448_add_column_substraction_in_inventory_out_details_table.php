<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSubstractionInInventoryOutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_out_details', function (Blueprint $table) {
            $table->tinyInteger("subtraction")->after('BC')->default(0);
            $table->string("reason")->after('BC');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_out_details', function (Blueprint $table) {
            $table->dropColumn('subtraction');
            $table->dropColumn('reason');
        });
    }
}
