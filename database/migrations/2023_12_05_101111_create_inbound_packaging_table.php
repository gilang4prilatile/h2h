<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboundPackagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound_packaging', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packaging_id');
            $table->foreign("packaging_id")->references("id")->on("master_packages");
            $table->foreignId('inbound_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->json("details")->nullable();
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
        Schema::dropIfExists('inbound_packaging');
    }
}
