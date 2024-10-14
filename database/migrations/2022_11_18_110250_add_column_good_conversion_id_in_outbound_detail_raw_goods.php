<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnGoodConversionIdInOutboundDetailRawGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outbound_detail_raw_goods', function (Blueprint $table) {
            $table->foreignId('good_conversion_id')->nullable()->after('good_id');
            $table->foreign("good_conversion_id")->references("id")->on("goods");
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
            $table->dropColumn('good_conversion_id');
        });
    }
}
