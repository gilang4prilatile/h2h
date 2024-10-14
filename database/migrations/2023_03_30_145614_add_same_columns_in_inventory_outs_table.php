<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSameColumnsInInventoryOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_outs', function (Blueprint $table) {
            $table->string('penanggung_jawab')->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_outs', function (Blueprint $table) {
            $table->dropColumn('penanggung_jawab');
        });
    }
}
