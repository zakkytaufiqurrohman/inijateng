<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VAlbCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<SQL
            CREATE VIEW `v_alb_count` AS
            SELECT
            id,
            IF (password IS NULL OR password= '', 1, 0) + 
            IF (wa IS NULL OR wa = '', 1, 0) + 
            IF (kota IS NULL OR kota = '', 1, 0) + 
            IF (provinsi IS NULL OR provinsi = '', 1, 0)+
            IF (tempat_lahir IS NULL OR tempat_lahir = '', 1, 0) +
            IF (alamat IS NULL OR alamat = '', 1, 0) + 
            IF (tgl_lahir IS NULL, 1, 0) + 
            IF (foto IS NULL OR foto = '', 1, 0) + 
            -- begin detail
            IF (bukti_terdaftar IS NULL OR bukti_terdaftar = '', 1, 0) + 
            IF (ijazah_s1 IS NULL OR ijazah_s1 = '', 1, 0) + 
            IF (ijazah_s2 IS NULL OR ijazah_s2 = '', 1, 0) + 
            IF (no_alb IS NULL OR no_alb = '', 1, 0) + 
            IF (s1 IS NULL OR s1 = '', 1, 0) + 
            IF (s2 IS NULL OR s2 = '', 1, 0) + 
            IF (tgl_lulus_s1 IS NULL , 1, 0) + 
            IF (tgl_lulus_s2 IS NULL , 1, 0) + 
            IF (ktp IS NULL OR ktp = '', 1, 0) + 
            IF (pengantar_magang IS NULL OR pengantar_magang = '', 1, 0) +
            IF (suket_pengda IS NULL OR suket_pengda = '', 1, 0) + 
            IF (penerima_magang IS NULL OR penerima_magang = '', 1, 0) + 
            IF (masa_magang IS NULL OR masa_magang = '', 1, 0) + 
            IF (tempat_magang IS NULL OR tempat_magang = '', 1, 0) + 
            IF (tgl_no_surat IS NULL, 1, 0) + 
            IF (magang_ke IS NULL OR magang_ke = '', 1, 0) 
            as empty_count from v_alb
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
            DROP VIEW IF EXISTS `v_alb_count`;
            SQL;
        \DB::statement($query);

    }
}
