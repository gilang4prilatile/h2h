<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterIncotermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_incoterms', function (Blueprint $table) {
            $table->id();
            $table->string('code',3)->unique();
            $table->text('description')->nullable();
            $table->string('formula');
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
        Schema::dropIfExists('master_incoterms');
    }
}
