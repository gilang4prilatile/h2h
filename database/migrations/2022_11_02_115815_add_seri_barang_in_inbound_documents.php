<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeriBarangInInboundDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbound_documents', function (Blueprint $table) {
            $table->integer('seri_barang')->after('inbound_detail_id');
            $table->integer('seri_document')->after('inbound_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inbound_documents', function (Blueprint $table) {
            $table->dropColumn('seri_barang');
            $table->dropColumn('seri_document');
        });
    }
}
