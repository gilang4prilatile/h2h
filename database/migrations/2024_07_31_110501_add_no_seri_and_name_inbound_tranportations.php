<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoSeriAndNameInboundTranportations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inbound_transportations', function (Blueprint $table) {
            $table->integer('no_seri')->after('id'); 
            $table->string('name')->nullable()->after('transportation_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inbound_transportations', function (Blueprint $table) {
            $table->dropColumn('no_seri');
            $table->dropColumn('name'); 
        });
    }
}
