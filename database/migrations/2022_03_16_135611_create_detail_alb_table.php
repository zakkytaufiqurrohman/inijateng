<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAlbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_alb', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('no_alb')->nullable();
            $table->string('s1')->nullable();
            $table->date('tgl_lulus_s1')->nullable();
            $table->string('s2')->nullable();
            $table->date('tgl_lulus_s2')->nullable();
            $table->string('bukti_terdaftar')->nullable();
            $table->string('ijazah_s1')->nullable();
            $table->string('ijazah_s2')->nullable();
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
        Schema::dropIfExists('detail_alb');
    }
}
