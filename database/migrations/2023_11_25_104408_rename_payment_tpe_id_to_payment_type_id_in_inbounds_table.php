<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePaymentTpeIdToPaymentTypeIdInInboundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbounds', function (Blueprint $table) {
            $table->renameColumn('payment_tpe_id', 'payment_type_id');
            $table->renameColumn('import_id', 'import_type_id');
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
            $table->renameColumn('payment_type_id', 'payment_tpe_id');
            $table->renameColumn('import_type_id', 'import_id');
        });
    }
}
