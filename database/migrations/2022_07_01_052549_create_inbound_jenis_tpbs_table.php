<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboundJenisTpbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound_jenis_tpbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inbound_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('jenis_tpb_id');
            $table->foreign("jenis_tpb_id")->references("id")->on("master_jenis_tpb");
            $table->string('type')->nullable()->comment('asal/tujuan');
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
        Schema::dropIfExists('inbound_jenis_tpbs');
    }
}
