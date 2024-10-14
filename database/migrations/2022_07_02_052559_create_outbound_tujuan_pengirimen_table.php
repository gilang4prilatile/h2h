<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboundTujuanPengirimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound_tujuan_pengirimen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outbound_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tujuan_pengiriman_id');
            $table->foreign("tujuan_pengiriman_id")->references("id")->on("master_tujuan_pengiriman");
            $table->timestamps();
            $table->foreignId('created_by')->nullable();
            $table->foreign("created_by")->references("id")->on("users");
            $table->foreignId('updated_by')->nullable();
            $table->foreign("updated_by")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outbound_tujuan_pengirimen');
    }
}
