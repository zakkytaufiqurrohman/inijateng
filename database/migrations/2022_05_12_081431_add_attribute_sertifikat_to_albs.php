<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeSertifikatToAlbs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('albs', function (Blueprint $table) {
            $table->string('nomor');
            $table->string('tempat_dan_tanggal');
            $table->string('ketua');
            $table->string('sekretaris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('albs', function (Blueprint $table) {
            $table->dropColumn('nomor');
            $table->dropColumn('tempat_dan_tanggal');
            $table->dropColumn('ketua');
            $table->dropColumn('sekretaris');
        });
    }
}
