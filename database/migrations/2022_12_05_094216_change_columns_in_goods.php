<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->decimal('nett_weight', 15, 5)->change();
            $table->decimal('volume', 15, 5)->change();
            $table->decimal('amount', 15, 5)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->decimal('nett_weight', 15, 2)->change();
            $table->decimal('volume', 15, 2)->change();
            $table->decimal('amount', 15, 2)->change();
        });
    }
}
