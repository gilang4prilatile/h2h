<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacilityGoodInboundProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbound_profiles', function (Blueprint $table) {
            $table->json('good_facility')->nullable()->after('type'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inbound_profiles', function (Blueprint $table) {
            $table->dropColumn('good_facility'); 
        });
    }
}
