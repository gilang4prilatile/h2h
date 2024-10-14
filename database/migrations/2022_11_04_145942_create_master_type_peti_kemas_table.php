<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTypePetiKemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_type_peti_kemas', function (Blueprint $table) {
            $table->id();
            $table->string("name");
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
        Schema::dropIfExists('master_type_peti_kemas');
    }
}
