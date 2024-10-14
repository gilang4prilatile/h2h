<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLartasHscodeInboundDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbound_details', function (Blueprint $table) {
            $table->integer('lartas')->nullable()->after('hs_code_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inbound_details', function (Blueprint $table) {
            $table->dropColumn('lartas'); 
        });
    } 
}
