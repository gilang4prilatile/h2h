<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboundPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outbound_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('package_id');
            $table->foreign("package_id")->references("id")->on("master_packages");
            $table->json("details")->nullable();
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
        Schema::dropIfExists('outbound_packages');
    }
}
