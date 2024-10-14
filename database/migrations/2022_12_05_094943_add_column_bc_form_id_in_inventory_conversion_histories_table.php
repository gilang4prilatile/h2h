<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBcFormIdInInventoryConversionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_conversion_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('bc_form_id')->nullable()->after('code_production');
            $table->foreign("bc_form_id")->references("id")->on("bc_forms");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_conversion_histories', function (Blueprint $table) {
            $table->dropForeign(['bc_form_id']);
            $table->dropColumn("bc_form_id");
        });
    }
}
