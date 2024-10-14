<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outbound_id')->constrained();
            $table->bigInteger("quantity");
            $table->decimal('nett_weight', 15, 2);
            $table->decimal('volume', 15, 2);
            $table->decimal('amount', 15, 2);
            $table->foreignId('package_id');
            $table->foreign("package_id")->references("id")->on("master_packages");
            $table->json("package_details")->nullable();
            $table->timestamps();
            $table->json('details')->nullable();
            $table->foreignId('good_id')->constrained();
            $table->nullableMorphs('detailable');
            $table->foreignId('hs_code_id')->nullable();
            $table->foreign("hs_code_id")->references("id")->on("hs_codes");
            $table->foreignId('rate_preference_id')->nullable();
            $table->foreign("rate_preference_id")->references("id")->on("rate_preferences");
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
        Schema::dropIfExists('outbound_details');
    }
}
