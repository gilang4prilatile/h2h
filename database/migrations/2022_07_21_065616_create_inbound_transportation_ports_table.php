<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboundTransportationPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound_transportation_ports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inbound_transportation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('port_id')->constrained();
            $table->string('type')->comment("muat/transit/bongkar");
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
        Schema::dropIfExists('inbound_transportation_ports');
    }
}
