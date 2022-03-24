<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magber;
use App\Models\MagberTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MagberTransactionController extends Controller
{
    public function bendaharaIndex($id)
    {
        return view('Admin.magber.bendahara',compact('id'));
    }
    
    public function bendahara(Request $request){
        //tampilakan data dengan event magber yang aktif
        $magberEfent = Magber::where('status','1')->first();
        //filter maber ke berapa ?
        $data = MagberTransaction::with('user')->where('magber_id',$magberEfent->id)->where('bendahara_status',$request->status)->get();
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
        $magberEfent = Magber::where('status','1')->first();
        $data = MagberTransaction::with('user','detail_alb')->where('magber_id',$magberEfent->id)->where('bendahara_status',0)->first();

        return view('Admin.magber.bendahara_verified',compact('data'));
    }
}
