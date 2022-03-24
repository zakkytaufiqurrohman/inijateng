<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatMagangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_magang', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('penerima_magang');
            $table->string('tempat_magang');  
            $table->string('wilayah_kerja');  
            $table->string('masa_magang');  
            $table->string('tgl_no_surat');  
            $table->string('magang_ke');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_magang');
    }
}
