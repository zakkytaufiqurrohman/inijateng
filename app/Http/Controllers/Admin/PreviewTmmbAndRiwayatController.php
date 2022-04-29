<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiwayatMagang;
use App\Models\RiwayatTTMB;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PreviewTmmbAndRiwayatController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.priview_ttmb_dan_r_magang');
    }

    public function data(Request $request)
    {
        $data = User::query();
        $data->where('status_anggota','alb');
        // if($request->id){
        //     $data->where('status_anggota',$request->id);
        // }
        $data->orderBy('id', 'DESC');
        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {

                $action = '';
                $link = route('preview_riwayat.detail',$data->id);
                $action .= "<a href='$link' class='btn btn-icon btn-primary'><i class='fa fa-credit-card'></i></a>&nbsp;";
                return $action;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function detail($id)
    {
        $magangs = RiwayatMagang::with('user')->where('user_id',$id)->get();

        $ttmbs = RiwayatTTMB::with('user')->where('user_id',$id)->get();
        return view('Admin.priview_ttmb_dan_r_magang_detail',compact('magangs','ttmbs'));
    }
}
