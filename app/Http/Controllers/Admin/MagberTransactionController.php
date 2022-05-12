<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magber;
use App\Models\MagberTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MagberTransactionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bendahara_alb', ['only' => [
            'bendaharaIndex',
            'bendahara',
        ]]);
        $this->middleware('permission:verifikator_maber_1|verifikator_maber_2|verifikator_maber_3|verifikator_maber_4', ['only' => [
            'verifikasiIndex',
            'verifikasi_validasi',
        ]]);


    }
    public function bendaharaIndex($id)
    {
        return view('Admin.magber.bendahara',compact('id'));
    }
    
    public function bendahara(Request $request){
        $filters = '%';
        if(!empty($request->id)){
            $filters = $request->id;
        }
        //tampilakan data dengan event magber yang aktif
        $magberEfent = Magber::where('status','1')->first();
        //filter maber ke berapa ?
        $data = MagberTransaction::with('user')->where('magber_ke','like',$filters)->where('magber_id',$magberEfent->id)->where('bendahara_status',$request->status)->get();
        // $data->orderBy('id', 'DESC');
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $link = route('bendahara_maber.show',$data->id);
                $action = '';
                $action .= "<a href='$link' class='btn btn-icon btn-primary'><i class='fa fa-edit'></i></a>&nbsp;";

                return $action;
            })
            ->addColumn('nik',function ($data) {
              

                return $data->user->nik;
            })
            ->addColumn('wa', function ($data) {


                return $data->user->wa;
            })
            ->addColumn('name', function ($data) {


                return $data->user->name;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id){
        $magberEvent = Magber::where('status','1')->first();
        $data = MagberTransaction::with(['user' => function($user){
            $user->with(['kotas','provincies','lahir'])->first();
        },'detail_alb','detail_berkas_alb'])
        ->where('id',$id)->where('magber_id',$magberEvent->id)->first();

        return view('Admin.magber.bendahara_verified',compact('data'));
    }

    public function validasi(Request $request){
        $statuss = '0';
        if($request->status == 0){
            $statuss = '1';
        }
        if($request->status == 1){
            $statuss = '0';
        }
        $maber_event = Magber::where('status','1')->first();
        $data = MagberTransaction::where('magber_id',$maber_event->id)->where('id',$request->id)->first();
        $data->bendahara_status = $statuss;
        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Berhasil Merubah Status']);
    }

    public function verifikasiIndex($maber,$id)
    {
        return view('Admin.magber.verifikasi',compact('maber','id'));
    }

    public function verifikasi(Request $request){
        //tampilakan data dengan event magber yang aktif
        $magberEfent = Magber::where('status','1')->first();
        //filter maber ke berapa ?
        $data = MagberTransaction::with('user')->where('magber_ke',$request->id)->where('magber_id',$magberEfent->id)->where('verifikasi_status',$request->status)->get();
        // $data->orderBy('id', 'DESC');
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $link = route('verifikasi_maber.show',['maber'=>$data->magber_ke,'user'=>$data->id]);
                $action = '';
                $action .= "<a href='$link' class='btn btn-icon btn-primary'><i class='fa fa-edit'></i></a>&nbsp;";

                return $action;
            })
            ->addColumn('nik',function ($data) {
                return $data->user->nik;
            })
            ->addColumn('wa', function ($data) {
                return $data->user->wa;
            })
            ->addColumn('name', function ($data) {
                return $data->user->name;
            })
            ->addColumn('kota', function ($data) {
                return $data->user->v_alb->kota_name;
            })
            ->addColumn('provinsi', function ($data) {
                return $data->user->v_alb->provinsi_name;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function verifikasi_show($maber,$id)
    {
        $magberEvent = Magber::where('status','1')->first();
        $data = MagberTransaction::with('user','detail_alb','detail_berkas_alb')->where('magber_ke',$maber)->where('id',$id)->where('magber_id',$magberEvent->id)->first();
        $data['link_group'] = $magberEvent->link_group;

        return view('Admin.magber.verifikasi_verified',compact('maber','data'));
    }

    public function verifikasi_validasi(Request $request)
    {
        $status = (($request->status==0)&&$request->status<>1) ? 1 : 0;
        $data = MagberTransaction::where('magber_ke',$request->maber)->where('id',$request->id)->first();
        $data->verifikasi_status = $status;
        $data->save();

        return response()->json(['status' => 'success', 'message' => 'Berhasil Merubah Status']);
    }

    public function sertifikatIndex($maber)
    {
        return view('Admin.magber.sertifikat.index',compact('maber'));
    }

    public function sertifikatData(Request $request){
        //tampilakan data dengan event magber yang aktif
        $magberEfent = Magber::where('status','1')->first();
        //filter maber ke berapa ?
        $data = MagberTransaction::with('user')->where('magber_ke',$request->id)->where('magber_id',$magberEfent->id)->where('verifikasi_status',1)->where('bendahara_status',1)->get();
        // $data->orderBy('id', 'DESC');
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $link = route('sertifikat.print',$data->id);
                $action = "<a target='_blank' href='$link' class='btn btn-icon btn-primary'>Setifikat</a>&nbsp;";

                return $action;
            })
            ->addColumn('nik',function ($data) {
                return $data->user->nik;
            })
            ->addColumn('wa', function ($data) {
                return $data->user->wa;
            })
            ->addColumn('name', function ($data) {
                return $data->user->name;
            })
            ->addColumn('kota', function ($data) {
                return $data->user->v_alb->kota_name;
            })
            ->addColumn('provinsi', function ($data) {
                return $data->user->v_alb->provinsi_name;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function sertifikatPrint($id)
    {
        $magber = Magber::findOrFail($id);
        $trans = MagberTransaction::with('user','detail_alb','riwayat_magang')->first();
        if(empty($trans)){
            return 'error';
        }
        return view('Admin.magber.sertifikat.sertifikat',compact('magber','trans'));
    }
}
