<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVNotarisCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<SQL
        CREATE VIEW `v_notaris_count` AS
        SELECT
            id,
            IF (wa IS NULL OR wa = '', 1, 0) + 
            IF (kota IS NULL OR kota = '', 1, 0) + 
            IF (provinsi IS NULL OR provinsi = '', 1, 0)+
            IF (tempat_lahir IS NULL OR tempat_lahir = '', 1, 0) + 
            IF (tgl_lahir IS NULL, 1, 0) + 
            IF (foto IS NULL OR foto = '', 1, 0) + 
            -- begin detail
            IF (telephone IS NULL OR telephone = '', 1, 0) + 
            IF (npwp IS NULL OR npwp = '', 1, 0) + 
            IF (alamat_kantor IS NULL OR alamat_kantor = '', 1, 0) + 
            IF (ktp_img IS NULL OR ktp_img = '', 1, 0) + 
            IF (sk_notaris IS NULL OR sk_notaris = '', 1, 0) + 
            IF (sk_ppt IS NULL OR sk_ppt = '', 1, 0) + 
            IF (no_kta_ini IS NULL OR no_kta_ini = '', 1, 0) + 
            IF (scan_npwp IS NULL OR scan_npwp = '', 1, 0) + 
            IF (no_sk_notaris IS NULL OR no_sk_notaris = '', 1, 0) + 
            IF (asal_pengda IS NULL OR asal_pengda = '', 1, 0) 
            as empty_count from v_notaris
        SQL;

        \DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $query = <<<SQL
        DROP VIEW IF EXISTS `v_notaris_count`;
        SQL;
        \DB::statement($query);
    }
}
