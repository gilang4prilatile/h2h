<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMasterKppbcIdPorts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ports', function (Blueprint $table) {
            $table->unsignedBigInteger('master_kppbc_id')->nullable()->after('country_id'); 
            $table->foreign('master_kppbc_id')->references('id')->on('master_kppbc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ports', function (Blueprint $table) {
            $table->dropForeign('master_kppbc_id'); 
            $table->dropColumn('master_kppbc_id'); 
        });
    }
}