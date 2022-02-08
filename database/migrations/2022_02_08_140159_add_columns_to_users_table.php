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
            $table->string('npwp',50)->notNull();
            $table->string('phone_number',15)->notNull();
            $table->string('office_number',15)->notNull();
            $table->integer('kota')->unsigned();
            $table->integer('provinsi')->unsigned();
            $table->string('alamat_kantor',50)->notNull();
            $table->integer('tempat_lahir')->unsigned()->notNull();
            $table->date('tgl_lahir')->notNull();
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
            $table->dropColumn('npwp');
            $table->dropColumn('phone_number');
            $table->dropColumn('office_number');
            $table->dropColumn('kota');
            $table->dropColumn('provinsi');
            $table->dropColumn('alamat_kantor');
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tgl_lahir');
        });
    }
}
