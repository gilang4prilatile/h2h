<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoSeriContainerKemasanInbound extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbound_container', function (Blueprint $table) {
            $table->integer('no_seri')->after('id'); 
        });
        Schema::table('inbound_packaging', function (Blueprint $table) {
            $table->integer('no_seri')->after('id'); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inbound_container', function (Blueprint $table) {
            $table->dropColumn('no_seri'); 
        });
        Schema::table('inbound_packaging', function (Blueprint $table) {
            $table->dropColumn('no_seri'); 
        });
    }
}
