<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTypeGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_type_goods', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->string('name');
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
        Schema::dropIfExists('master_type_goods');
    }
}
