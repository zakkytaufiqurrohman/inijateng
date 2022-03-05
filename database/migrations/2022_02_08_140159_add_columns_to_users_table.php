<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('nik',16)->notNull();
            $table->string('wa',15)->notNull();//pakai +62
            $table->integer('kota')->unsigned();
            $table->integer('provinsi')->unsigned();
            $table->integer('tempat_lahir')->unsigned()->notNull();
            $table->date('tgl_lahir')->notNull();
            $table->string('status_anggota',10)->notNull();
            $table->string('foto',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('nik');
            $table->dropColumn('wa');
            $table->dropColumn('kota');
            $table->dropColumn('provinsi');
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tgl_lahir');
            $table->dropColumn('status_anggota');
            $table->dropColumn('foto');
        });
    }
}
