<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsBcTypeOnBcFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bc_forms', function (Blueprint $table) {
            $table->enum('type', ['inbound', 'outbound'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bc_forms', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
