<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBerkasAlbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_berkas_alb', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('ktp')->nullable();
            $table->string('pengantar_magang')->nullable();
            $table->string('suket_pengda')->nullable();
            $table->string('rekomendasi_pengda')->nullable();
            $table->string('ttmb1')->nullable();
            $table->string('ttmb2')->nullable();
            $table->string('ttmb3')->nullable();
            $table->string('ttmb4')->nullable();
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
        Schema::dropIfExists('detail_berkas_alb');
    }
}
