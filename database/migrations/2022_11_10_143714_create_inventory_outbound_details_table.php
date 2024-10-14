<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryOutboundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_outbound_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("outbound_id");
            $table->foreign("outbound_id")->references("id")->on("outbounds");
            $table->foreignId("outbound_detail_id"); 
            $table->foreign("outbound_detail_id")->references("id")->on("outbound_details");
            $table->foreignId("inventory_id"); 
            $table->foreign("inventory_id")->references("id")->on("inventories");
            $table->foreignId("inv_conversion_history_id"); 
            $table->foreign("inv_conversion_history_id")->references("id")->on("inventory_conversion_histories");
            $table->foreignId("inbound_id"); 
            $table->foreign("inbound_id")->references("id")->on("inbounds");
            $table->foreignId("inbound_detail_id"); 
            $table->foreign("inbound_detail_id")->references("id")->on("inbound_details");
            $table->foreignId("good_id"); 
            $table->foreign("good_id")->references("id")->on("goods");
            $table->foreignId("good_conversion_id"); 
            $table->foreign("good_conversion_id")->references("id")->on("goods");
            $table->bigInteger("quantity_outbound")->default(0); 
            $table->bigInteger("quantity_good_conversion")->default(0);
            $table->integer("status")->default(0);
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
        Schema::dropIfExists('inventory_outbound_details');
    }
}
