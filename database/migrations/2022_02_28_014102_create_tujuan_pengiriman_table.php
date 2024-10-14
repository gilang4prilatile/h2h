<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTujuanPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_tujuan_pengiriman', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("warehouse_id")->nullable();

            $table->string("code");
            $table->string("name");

            $table->foreign("warehouse_id")
                ->references("id")
                ->on("warehouses")
                ->onUpdate("cascade")
                ->onDelete("restrict");

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
        Schema::dropIfExists('master_tujuan_pengiriman');
    }
}
