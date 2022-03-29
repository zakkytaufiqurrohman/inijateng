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
        $data = AlbTransaction::where('alb_id',$alb_event->id)->where('bendahara_status','0')->first();
        return view('Admin.alb.bendahara_verified',compact('data'));
    }
}
