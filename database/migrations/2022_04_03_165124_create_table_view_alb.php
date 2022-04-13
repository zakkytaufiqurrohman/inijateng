<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableViewAlb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW `v_alb` AS
            SELECT u.*, 
                da.id as da_id, 
                da.bukti_terdaftar, 
                da.ijazah_s1, 
                da.ijazah_s2, 
                da.no_alb, 
                da.s1,
                da.s2, 
                da.tgl_lulus_s1, 
                da.tgl_lulus_s2, 
                da.alamat,
                dba.id as dba_id, 
                dba.ktp,
                dba.pengantar_magang, 
                dba.suket_pengda, 
                dba.ttmb1, 
                dba.ttmb2,
                dba.ttmb3, 
                dba.ttmb4,
                rm.id as rm_id, 
                rm.penerima_magang, 
                rm.masa_magang, 
                rm.tempat_magang, 
                rm.tgl_no_surat, 
                rm.magang_ke,
                rt.id as rt_id, 
                rt.pengwil, 
                rt.nilai, 
                rt.tgl_nomor, 
                rt.materi, 
                rt.tgl_pelaksanaan,
                rt.magang_ke as ttmb_magang_ke,
                t.`name` as tempat_lahir_name,
                ic.`name` as kota_name,
                ip.`name` as provinsi_name
                FROM users u 
                left join indonesia_cities ic on ic.id = u.kota
                left join indonesia_provinces ip on ip.id = u.provinsi
                left join indonesia_cities t on t.id = u.tempat_lahir
                LEFT JOIN detail_alb da on da.user_id=u.id
                LEFT JOIN detail_berkas_alb dba on dba.user_id=u.id
                LEFT JOIN (
                    SELECT rm.id as id_rm, rm.* FROM riwayat_magang rm 
                    JOIN (
                        SELECT user_id, max(magang_ke) as mk
                        FROM riwayat_magang rm group by user_id
                    ) b on b.user_id=rm.user_id and b.mk=rm.magang_ke
                ) rm on rm.user_id=u.id
                LEFT JOIN (
                    SELECT rt.* FROM riwayat_ttmb rt
                    JOIN (
                        SELECT user_id, max(magang_ke) as mk
                        FROM riwayat_ttmb rt group by user_id
                    ) b on b.user_id=rt.user_id and b.mk=rt.magang_ke
                ) rt on rt.user_id=u.id 
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
            DROP VIEW IF EXISTS `v_alb`;
            SQL;
       \DB::statement($query);
    }
}
