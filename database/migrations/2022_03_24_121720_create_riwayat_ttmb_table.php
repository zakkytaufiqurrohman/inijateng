<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTtmbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_ttmb', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('pengwil');
            $table->date('tgl_pelaksanaan');
            $table->longText('materi');
            $table->string('nilai');
            $table->string('tgl_nomor');
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
        Schema::dropIfExists('riwayat_ttmb');
    }
}
