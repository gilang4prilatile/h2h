<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBc11InInboundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbounds', function (Blueprint $table) {
            $table->string('no_dokumen_bc')->nullable();
            $table->string('dokumen_bc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inbounds', function (Blueprint $table) {
            $table->dropColumn('no_dokumen_bc');
            $table->dropColumn('dokumen_bc');
        });
    }
}
