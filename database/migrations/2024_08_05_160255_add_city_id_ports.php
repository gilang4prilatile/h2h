<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdPorts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ports', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable()->after('id'); 
            $table->foreign('country_id')->references('id')->on('countries');
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
            $table->dropForeign('ports_country_id_foreign'); 
        });
    }
}
