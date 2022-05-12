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
            $table->string('tempat');
            $table->string('tanggal');
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
            $table->dropColumn('tempat');
            $table->dropColumn('tanggal');
            $table->dropColumn('ketua');
            $table->dropColumn('sekretaris');
        });
    }
}
