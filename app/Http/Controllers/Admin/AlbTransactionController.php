<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alb;
use App\Models\AlbTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AlbTransactionController extends Controller
{
    public function bendaharaIndex($id)
    {
        return view('Admin.alb.bendahara',compact('id'));
    }
    
    public function bendahara(Request $request){
        //tampilakan data dengan event alb yang aktif
        $alb_event = Alb::where('status','1')->first();
        //filter maber ke berapa ?
        $data = AlbTransaction::where('alb_id',$alb_event->id)->where('bendahara_status',$request->status)->get();
        // $data->orderBy('id', 'DESC');
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $link = route('bendahara_alb.show',$data->id);
                $action = '';
                $action .= "<a href='$link' class='btn btn-icon btn-primary'><i class='fa fa-edit'></i></a>&nbsp;";

                return $action;
            })
            ->addColumn('nik',function ($data) {
              

                return $data->nik;
            })
            ->addColumn('wa', function ($data) {


                return $data->wa;
            })
            ->addColumn('name', function ($data) {


                return $data->name;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id){
        $alb_event = Alb::where('status','1')->first();
        $data = AlbTransaction::where('alb_id',$alb_event->id)->where('id',$id)->first();
        return view('Admin.alb.bendahara_verified',compact('data'));
    }

    public function validasi(Request $request){
        $statuss = '0';
        if($request->status == 0){
            $statuss = '1';
        }
        if($request->status == 1){
            $statuss = '0';
        }
        $alb_event = Alb::where('status','1')->first();
        $data = AlbTransaction::where('alb_id',$alb_event->id)->where('id',$request->id)->first();
        $data->bendahara_status = $statuss;
        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Berhasil Merubah Status']);
    }

    public function edit(Request $request){

        $data = AlbTransaction::find($request->id);
        $data->wa = $request->wa;
        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Berhasil Merubah Data']);
    }

    public function verifikasiIndex($id)
    {
        return view('Admin.alb.verifikasi',compact('id'));
    }

    public function verifikasi(Request $request){
        
        //tampilakan data dengan event  yang aktif
        $AlbEvent = Alb::where('status','1')->first();
        $data = AlbTransaction::with('provincies','kotas')->where('verifikator_status',$request->status)->where('alb_id',$AlbEvent->id)->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $link = route('verifikasi_alb.show',$data->id);
                $action = '';
                $action .= "<a href='$link' class='btn btn-icon btn-primary'><i class='fa fa-edit'></i></a>&nbsp;";

                return $action;
            })
            ->addColumn('nik',function ($data) {
                return $data->nik;
            })
            ->addColumn('wa', function ($data) {
                return $data->wa;
            })
            ->addColumn('name', function ($data) {
                return $data->nama;
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

    public function verifikasi_show($id)
    {
        $alb_event = Alb::where('status','1')->first();
        $data = AlbTransaction::with('provincies','kotas')->where('alb_id',$alb_event->id)->where('id',$id)->first();
        $data['link_group'] = $alb_event->link_group;

        return view('Admin.alb.verifikasi_verified',compact('alb_event','data'));
    }

    public function verifikasi_validasi(Request $request)
    {
        $status = (($request->status==0)&&$request->status<>1) ? '1' : '0';
        $data = AlbTransaction::where('id',$request->id)->first();
        $data->verifikator_status = $status;
        $data->save();

        return response()->json(['status' => 'success', 'message' => 'Berhasil Merubah Status']);
    }
}
