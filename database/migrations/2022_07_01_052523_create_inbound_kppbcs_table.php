<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboundKppbcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound_kppbcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inbound_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kppbc_id');
            $table->foreign("kppbc_id")->references("id")->on("master_kppbc");
            $table->string('type')->nullable()->comment('bongkar/pengawas');
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
        Schema::dropIfExists('inbound_kppbcs');
    }
}
