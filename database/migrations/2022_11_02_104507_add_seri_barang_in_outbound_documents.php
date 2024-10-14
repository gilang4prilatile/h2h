<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeriBarangInOutboundDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outbound_documents', function (Blueprint $table) {
            $table->integer('seri_barang')->after('outbound_detail_id');
            $table->integer('seri_document')->after('outbound_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outbound_documents', function (Blueprint $table) {
            $table->dropColumn('seri_barang');
            $table->dropColumn('seri_document');
        });
    }
}
