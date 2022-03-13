<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomToDetailNotaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_notaris', function (Blueprint $table) {
            $table->string('scan_npwp',200);
            $table->string('no_sk_notaris',200); //char
            $table->string('asal_pengda',200); // hanya kota di jateng
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_notaris', function (Blueprint $table) {
            $table->dropColumn('scan_npwp');
            $table->dropColumn('no_sk_notaris');
            $table->dropColumn('asal_pengda');
        });
    }
}
