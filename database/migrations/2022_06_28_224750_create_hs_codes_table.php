<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHsCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hs_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type')->comment('bab/pos/sub-pos/sub-pos-asean');
            $table->json('details')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->foreign("parent_id")->references("id")->on("hs_codes");
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
        Schema::dropIfExists('hs_codes');
    }
}
