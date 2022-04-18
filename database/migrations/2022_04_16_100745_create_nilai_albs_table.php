<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiAlbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_albs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alb_id');
            $table->unsignedBigInteger('alb_transaction_id');
            $table->double('nilai_wawancara');
            $table->double('nilai_tertulis');
            $table->string('status_lulus');
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
        Schema::dropIfExists('nilai_albs');
    }
}
