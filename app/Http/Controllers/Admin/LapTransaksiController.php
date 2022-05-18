<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alb;
use App\Models\AlbTransaction;
use App\Models\Magber;
use App\Models\MagberTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LapTransaksiController extends Controller
{
    public function index()
    {
        $alb = Alb::where('status', '1')->first();
        $magber = Magber::where('status', '1')->first();

        $alb_total = AlbTransaction::where('alb_id', $alb->id)->count();
        $alb_bendahara = AlbTransaction::where('alb_id', $alb->id)->where('bendahara_status', '1')->count();
        $alb_verif = AlbTransaction::where('alb_id', $alb->id)->where('verifikator_status', '1')->count();

        $magber_total = MagberTransaction::where('magber_id', $magber->id)->where('magber_ke', 1)->count();
        $magber_bendahara = MagberTransaction::where('magber_id', $magber->id)->where('bendahara_status', '1')->where('magber_ke', 1)->count();
        $magber_verif = MagberTransaction::where('magber_id', $magber->id)->where('verifikasi_status', '1')->where('magber_ke', 1)->count();

        $magber_total2 = MagberTransaction::where('magber_id', $magber->id)->where('magber_ke', 2)->count();
        $magber_bendahara2 = MagberTransaction::where('magber_id', $magber->id)->where('bendahara_status', '1')->where('magber_ke', 2)->count();
        $magber_verif2 = MagberTransaction::where('magber_id', $magber->id)->where('verifikasi_status', '1')->where('magber_ke', 2)->count();

        $magber_total3 = MagberTransaction::where('magber_id', $magber->id)->where('magber_ke', 3)->count();
        $magber_bendahara3 = MagberTransaction::where('magber_id', $magber->id)->where('bendahara_status', '1')->where('magber_ke', 3)->count();
        $magber_verif3 = MagberTransaction::where('magber_id', $magber->id)->where('verifikasi_status', '1')->where('magber_ke', 3)->count();

        $magber_total4 = MagberTransaction::where('magber_id', $magber->id)->where('magber_ke', 4)->count();
        $magber_bendahara4 = MagberTransaction::where('magber_id', $magber->id)->where('bendahara_status', '1')->where('magber_ke', 4)->count();
        $magber_verif4 = MagberTransaction::where('magber_id', $magber->id)->where('verifikasi_status', '1')->where('magber_ke', 4)->count();

        return view('Admin.lap_transaksi', compact(
            'alb_total',
            'alb_bendahara',
            'alb_verif',
            'magber_total',
            'magber_bendahara',
            'magber_verif',
            'magber_total2',
            'magber_bendahara2',
            'magber_verif2',
            'magber_total3',
            'magber_bendahara3',
            'magber_verif3',
            'magber_total4',
            'magber_bendahara4',
            'magber_verif4'
        ));
    }
    public function dataPeserta()
    {
        $alb = Alb::where('status', '1')->first();
        $magber = Magber::where('status', '1')->first();

        $alb_total = AlbTransaction::where('alb_id', $alb->id)->count();
        $alb_bendahara = AlbTransaction::where('alb_id', $alb->id)->where('bendahara_status', '1')->count();
        $alb_verif = AlbTransaction::where('alb_id', $alb->id)->where('verifikator_status', '1')->count();

        $magber_total = MagberTransaction::where('magber_id', $magber->id)->where('magber_ke', 1)->count();
        $magber_bendahara = MagberTransaction::where('magber_id', $magber->id)->where('bendahara_status', '1')->where('magber_ke', 1)->count();
        $magber_verif = MagberTransaction::where('magber_id', $magber->id)->where('verifikasi_status', '1')->where('magber_ke', 1)->count();

        $magber_total2 = MagberTransaction::where('magber_id', $magber->id)->where('magber_ke', 2)->count();
        $magber_bendahara2 = MagberTransaction::where('magber_id', $magber->id)->where('bendahara_status', '1')->where('magber_ke', 2)->count();
        $magber_verif2 = MagberTransaction::where('magber_id', $magber->id)->where('verifikasi_status', '1')->where('magber_ke', 2)->count();

        $magber_total3 = MagberTransaction::where('magber_id', $magber->id)->where('magber_ke', 3)->count();
        $magber_bendahara3 = MagberTransaction::where('magber_id', $magber->id)->where('bendahara_status', '1')->where('magber_ke', 3)->count();
        $magber_verif3 = MagberTransaction::where('magber_id', $magber->id)->where('verifikasi_status', '1')->where('magber_ke', 3)->count();

        $magber_total4 = MagberTransaction::where('magber_id', $magber->id)->where('magber_ke', 4)->count();
        $magber_bendahara4 = MagberTransaction::where('magber_id', $magber->id)->where('bendahara_status', '1')->where('magber_ke', 4)->count();
        $magber_verif4 = MagberTransaction::where('magber_id', $magber->id)->where('verifikasi_status', '1')->where('magber_ke', 4)->count();

        return view('Admin.dataPeserta', compact(
            'alb_total',
            'alb_bendahara',
            'alb_verif',
            'magber_total',
            'magber_bendahara',
            'magber_verif',
            'magber_total2',
            'magber_bendahara2',
            'magber_verif2',
            'magber_total3',
            'magber_bendahara3',
            'magber_verif3',
            'magber_total4',
            'magber_bendahara4',
            'magber_verif4'
        ));
    }

    public function albRegistered()
    {
        return view('Admin.alb.lap_alb_registered');
    }

    public function albRegisteredData(Request $request){
       
        $data = AlbTransaction::with('provincies','kotas','tempat_lahir')->get();
        return DataTables::of($data)
            ->addColumn('nik',function ($data) {
                return $data->nik;
            })
            ->addColumn('wa', function ($data) {
                return $data->wa;
            })
            ->addColumn('tempat_lahir', function ($data) {
                return $data->kotas->name;
            })
            ->addColumn('provinsi', function ($data) {
                return $data->provincies->name;
            })
            ->addColumn('kota', function ($data) {
                return $data->kotas->name;
            })
            
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function maberRegistered($maber)
    {
        return view('Admin.magber.lap_magber_registered',compact('maber'));
    }

    public function maberRegisteredData(Request $request){
       
        $data = MagberTransaction::with(['user' => function($user){
            $user->with(['kotas','provincies','lahir'])->get();
        },'detail_alb','riwayat_magangs','riwayat_ttmbs'])
        ->where('magber_ke',$request->id)->get();
        return DataTables::of($data)
            ->addColumn('nik',function ($data) {
                return $data->nik;
            })
            ->addColumn('wa', function ($data) {
                return optional($data->user)->wa;
            })
            ->addColumn('nama', function ($data) {
                return optional($data->user)->name;
            })
            ->addColumn('email', function ($data) {
                return optional($data->user)->email;
            })
            ->addColumn('tempat_lahir', function ($data) {
                return optional($data->user->lahir)->name;
            })
            ->addColumn('tanggal_lahir', function ($data) {
                return optional($data->user)->tgl_lahir;
            })
            ->addColumn('nik', function ($data) {
                return optional($data->user)->nik;
            })
            ->addColumn('provinsi', function ($data) {
                return optional($data->user->provincies)->name;
            })
            ->addColumn('kota', function ($data) {
                return optional($data->user->kotas)->name;
            })
            ->addColumn('alamat', function ($data) {
                return optional($data->detail_alb)->alamat;
            })
            ->addColumn('no_alb', function ($data) {
                return optional($data->detail_alb)->no_alb;
            })
            ->addColumn('s1', function ($data) {
                return optional($data->detail_alb)->s1;
            })
            ->addColumn('lulus_s1', function ($data) {
                return optional($data->detail_alb)->tgl_lulus_s1;
            })
            ->addColumn('s2', function ($data) {
                return optional($data->detail_alb)->s2;
            })
            ->addColumn('lulus_s2', function ($data) {
                return optional($data->detail_alb)->tgl_lulus_s2;
            })
            ->addColumn('no_alb', function ($data) {
                return optional($data->detail_alb)->no_alb;
            })
            ->addColumn('riwayat_magang', function ($data) {

                $riwayat = '';
                $riwayats = $data->riwayat_magangs();
                if ($riwayats->count() > 0) {
                    foreach ($riwayats->get() as $key => $data) {
                        $riwayat .= ($key + 1) . ". " . $data->penerima_magang . "<br>";
                    }
                }

                return $riwayat;
            })
            ->addColumn('riwayat_ttmb', function ($data) {

                $riwayat = '';
                $riwayats = $data->riwayat_ttmbs();
                if ($riwayats->count() > 0) {
                    foreach ($riwayats->get() as $key => $data) {
                        $riwayat .= ($key + 1) . ". " . $data->materi .' | '. $data->tgl_nomor. "<br>";
                    }
                }

                return $riwayat;
            })
            
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }
}
