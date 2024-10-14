<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeMasterTypePetiKemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_type_peti_kemas', function (Blueprint $table) {
            if (!Schema::hasColumn('master_type_peti_kemas', 'code')) {
                $table->string('code', 20)->unique()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_type_peti_kemas', function (Blueprint $table) {
            $table->dropColumn('code'); 
        });
    }
}
