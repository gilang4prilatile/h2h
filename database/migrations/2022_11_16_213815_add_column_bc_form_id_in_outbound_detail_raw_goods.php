<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBcFormIdInOutboundDetailRawGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outbound_detail_raw_goods', function (Blueprint $table) {
            $table->foreignId('bc_form_id')->nullable()->after('id');
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
        Schema::table('outbound_detail_raw_goods', function (Blueprint $table) {
            $table->dropColumn('bc_form_id');
        });
    }
}
