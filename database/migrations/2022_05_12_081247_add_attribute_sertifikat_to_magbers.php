<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeSertifikatToMagbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magbers', function (Blueprint $table) {
            $table->string('nomor');
            $table->string('tempat_dan_tanggal');
            $table->string('no_perkumpulan');
            $table->string('no_sk');
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
        Schema::table('magbers', function (Blueprint $table) {
            $table->dropColumn('nomor');
            $table->dropColumn('tempat_dan_tanggal');
            $table->dropColumn('no_perkumpulan');
            $table->dropColumn('no_sk');
            $table->dropColumn('ketua');
            $table->dropColumn('sekretaris');
        });
    }
}
