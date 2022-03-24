<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\RiwayatMagang;
use App\Models\RiwayatTTMB;
use DB;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class RiwayatMagangController extends Controller
{
    //
    public function index()
    {
        return view('Admin.alb.magang');
    }

    public function data()
    {
        $user_id = Auth::user()->id;
        $data = RiwayatMagang::where('user_id',$user_id)->orderBy('id','DESC');

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {

                $action = '';
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$data->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";

                return $action;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function data_ttmb()
    {
        $user_id = Auth::user()->id;
        $data = RiwayatTTMB::where('user_id',$user_id)->orderBy('id','DESC');

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {

                $action = '';
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$data->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";

                return $action;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }
}
