<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('good_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate()->comment("the good");
            $table->bigInteger('good_conversion_id')->comment("raw goods/bahan mentah");
            $table->bigInteger("quantity");
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
        Schema::dropIfExists('good_conversions');
    }
}
