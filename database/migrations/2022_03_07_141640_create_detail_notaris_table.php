<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailNotarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_notaris', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('npwp')->nullable();
            $table->string('telephone')->nullable();
            $table->string('alamat_kantor')->nullable();
            $table->string('ktp_img')->nullable();
            $table->string('sk_notaris')->nullable();
            $table->string('no_kta_ini')->nullable();
            $table->string('sk_ppt')->nullable();
            $table->string('no_kta_ppt')->nullable();
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
        Schema::dropIfExists('detail_notaris');
    }
}
