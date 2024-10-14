<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMasterKppbcCodePorts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ports', function (Blueprint $table) {
            $table->string('master_kppbc_code', 20)->nullable()->after('master_kppbc_id'); 
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
            $table->dropColumn('master_kppbc_code'); 
        });
    }
}
