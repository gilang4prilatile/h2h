<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCodeMasterUkuranPetiKemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_ukuran_peti_kemas', function (Blueprint $table) {
            $table->integer('code')->after('id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_ukuran_peti_kemas', function (Blueprint $table) {
            $table->dropColumn('code'); 
        });
    }
}
