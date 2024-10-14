<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_outs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 35);
            $table->integer('status')->default(1);
            $table->text('notes')->nullable();
            $table->tinyInteger('is_conversion')->default(0);
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
        Schema::dropIfExists('inventory_outs');
    }
}
