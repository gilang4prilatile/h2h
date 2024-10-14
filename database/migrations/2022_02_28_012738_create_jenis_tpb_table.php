<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisTpbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_jenis_tpb', function (Blueprint $table) {
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
        Schema::dropIfExists('master_jenis_tpb');
    }
}
