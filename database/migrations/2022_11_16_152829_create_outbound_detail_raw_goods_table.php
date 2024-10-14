<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboundDetailRawGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound_detail_raw_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outbound_detail_id')->constrained();
            $table->string('name');
            $table->string('kode_barang');
            $table->foreignId('uom_id')->nullable();
            $table->foreign("uom_id")->references("id")->on("master_uom");
            $table->decimal('nett_weight', 15, 2);
            $table->decimal('volume', 15, 2);
            $table->decimal('amount', 15, 2);
            $table->foreignId('inbound_detail_id')->nullable();
            $table->foreign("inbound_detail_id")->references("id")->on("inbound_details");
            $table->foreignId('good_id')->nullable();
            $table->foreign("good_id")->references("id")->on("goods");
            $table->foreignId('hs_code_id')->nullable();
            $table->foreign("hs_code_id")->references("id")->on("hs_codes");
            $table->json('details')->nullable();
            $table->integer('quantity');
            $table->foreignId('created_by')->nullable();
            $table->foreign("created_by")->references("id")->on("users");
            $table->foreignId('updated_by')->nullable();
            $table->foreign("updated_by")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outbound_detail_raw_goods');
    }
}
