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
}
