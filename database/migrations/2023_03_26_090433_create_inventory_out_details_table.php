<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryOutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_out_details', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_out_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('good_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('quantity', 30, 10);
            $table->string('BC');
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
        Schema::dropIfExists('inventory_out_details');
    }
}
