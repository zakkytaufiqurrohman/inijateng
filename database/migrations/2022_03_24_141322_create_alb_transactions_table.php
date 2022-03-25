<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alb_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alb_id');
            $table->string('kode');
            $table->string('nama');
            $table->string('nik',20);
            $table->string('email',100);
            $table->string('wa',20);
            $table->enum('bendahara_status',[0,1]);
            $table->enum('verifikator_status',[0,1]);
            $table->string('tempat_lahir');//hanya kabupaten
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota',20);
            $table->string('s1',100);
            $table->string('tahun_s1',5);
            $table->string('s2',100);
            $table->string('tahun_s2',5);
            $table->string('foto',255);
            $table->string('suket',255);
            $table->string('ijazah_s1',255);
            $table->string('ijazah_s2',255);
            $table->string('ktp',255);
            $table->string('bukti_bayar',255);
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
        Schema::dropIfExists('alb_transactions');
    }
}
