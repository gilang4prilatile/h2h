<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePartialQuantityDataTypeToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partials', function (Blueprint $table) {
            $table->decimal('Qty',30,10)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partials', function (Blueprint $table) {
            $table->bigInteger('Qty')->change();
        });
    }
}
