<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPibImportPamentTypeIntoInboundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbounds', function (Blueprint $table) {

            $table->string('pib_type_id')->nullable();
            $table->unsignedBigInteger('payment_tpe_id')->nullable();
            $table->unsignedBigInteger('import_id')->nullable();

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
            $table->dropColumn('pib_type_id');
            $table->dropColumn('payment_tpe_id');
            $table->dropColumn('import_id');
        });
    }
}
