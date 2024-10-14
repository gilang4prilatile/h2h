<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUniqueCodePorts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ports', function ($table) {
            $table->dropUnique(['code']); // Drops index 'geo_state_index' 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ports', function ($table) {
            $table->unique(['code']); // Drops index 'geo_state_index' 
        });
    }
}
