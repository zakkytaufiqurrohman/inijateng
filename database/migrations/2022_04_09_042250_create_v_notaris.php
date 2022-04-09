<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVNotaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<SQL
        CREATE VIEW `v_notaris` AS
        SELECT
            u.id,
            u.name,
            u.email,
            u.nik,
            u.wa,
            u.tgl_lahir,
            u.foto,
            t.`name` as tempat_lahir,
            ic.`name` as kota,
            ip.`name` as provinsi,
            da.asal_pengdas as asal_pengda,
            da.npwp,
            da.telephone,
            da.alamat_kantor,
            da.no_kta_ini,
            da.no_kta_ppt,
            da.ktp_img,
            da.sk_notaris,
            da.sk_ppt,
            da.no_sk_notaris,
            da.scan_npwp
 
            FROM users u 
            LEFT JOIN (
                select a.*,ct.`name` as asal_pengdas from detail_notaris a
                left JOIN indonesia_cities ct on a.asal_pengda = ct.id          
            ) da on da.user_id=u.id
            left join indonesia_cities ic on ic.id = u.kota
            left join indonesia_provinces ip on ip.id = u.provinsi
            left join indonesia_cities t on t.id = u.tempat_lahir

            WHERE u.status_anggota = 'notaris'

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
        DROP VIEW IF EXISTS `v_notaris`;
        SQL;
        \DB::statement($query);
    }
}
