<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKppbcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kppbc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("warehouse_id")->nullable();
            $table->string("code", 20)->unique()->index();
            $table->string("description");
            $table->timestamps();

            $table->foreign("warehouse_id")
                ->references("id")
                ->on("warehouses")
                ->onUpdate("cascade")
                ->onDelete("restrict");

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
        Schema::dropIfExists('master_kppbc');
    }
}
