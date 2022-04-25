<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alb;
use App\Models\AlbTransaction;
use App\Models\NilaiAlb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NilaiAlbController extends Controller
{
    public function index($id)
    {
        return view('Admin.alb.nilai',compact('id'));
    }
    
    public function data(Request $request){
        //tampilakan data dengan event alb yang aktif
        $alb_event = Alb::where('status','1')->first();
     
        if($request->status == 0){
            $data = AlbTransaction::leftJoin('nilai_albs','nilai_albs.alb_transaction_id','alb_transactions.id')
            ->whereNull('nilai_albs.nilai_wawancara')
            ->select(['alb_transactions.*'])
            ->where('bendahara_status','1')
            ->where('verifikator_status','1')
            ->where('alb_transactions.alb_id',$alb_event->id)
            ->get();
        }
        if($request->status == 1){
            $data = AlbTransaction::leftJoin('nilai_albs','nilai_albs.alb_transaction_id','alb_transactions.id')
            ->select(['alb_transactions.*','nilai_albs.nilai_wawancara','nilai_albs.nilai_tertulis','nilai_albs.status_lulus'])
            ->whereNotNull('nilai_albs.nilai_wawancara')
            ->where('bendahara_status','1')
            ->where('verifikator_status','1')
            ->where('alb_transactions.alb_id',$alb_event->id)
            ->get();
        }
       
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                if(empty($data->nilai_wawancara)){
                    $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='nilai(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                }
                else {
                    if($data->status_lulus) {
                        $link = route('sertifikat_alb',$data->id);
                        $action .= "<a href='$link' class='btn btn-icon btn-primary'><i class='fa fa-print'></i>Setifikat</a>&nbsp;";
                    }
                }

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
            ->addColumn('nilai_t', function ($data) {
                return $data->nilai_tertulis;
            })
            ->addColumn('nilai_w', function ($data) {
                return $data->nilai_wawancara;
            })
            ->addColumn('status', function ($data) {
                return $data->status_lulus;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

     public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'tulis' => 'required',
            'wawancara' => 'required'
            ],[
            'id.required' => 'id tidak boleh kosong'
          
        ]);
        DB::beginTransaction();
        try {
            $data = AlbTransaction::findOrFail($request->id);
            $wawancara = $request->input('wawancara');
            $tulis = $request->input('tulis');
            $lulus = 'Tidak Lulus';
            if($wawancara+$tulis >= 60){
                $lulus = 'Lulus';
            }
            $nilai = NilaiAlb::where('alb_transaction_id',$data->id)->count();
            if($nilai > 0 ){
                return response()->json(['status' => 'error', 'message' => 'data sudah ada']);
            }
            else {
                NilaiAlb::create([
                    'alb_id' => $data->alb_id,
                    'alb_transaction_id' => $data->id,
                    'nilai_wawancara' => $wawancara,
                    'nilai_tertulis' => $tulis,
                    'status_lulus' => $lulus
                ]);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil menambahkan Nilai.']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
