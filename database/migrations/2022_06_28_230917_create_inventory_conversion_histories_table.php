<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryConversionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_conversion_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_conversion_id')->constrained();
            $table->foreignId('inventory_id')->constrained();
            $table->bigInteger("quantity");
            $table->bigInteger("current_quantity");
            $table->enum('type', ['conversion', 'outbound']);
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
        Schema::dropIfExists('inventory_conversion_histories');
    }
}
