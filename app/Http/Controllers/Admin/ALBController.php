<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\DetailAlb;
use DB;

class ALBController extends Controller
{
    //
    public function index()
    {
        return '';
    }

    public function data_diri()
    {
        $user_id = Auth::id();
        $user = User::leftJoin('detail_alb', function($join) {
            $join->on('users.id', '=', 'detail_alb.user_id');
        })
        ->find($user_id);

        return view('Admin.alb.data_diri', compact('user'));
    }

    public function data_diri_edit()
    {
        $user_id = Auth::id();
        $user = User::leftJoin('detail_alb', function($join) {
            $join->on('users.id', '=', 'detail_alb.user_id');
        })
        ->find($user_id);

        return view('admin.alb.data_diri_edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_alb' => 'required',
            's1' => 'required',
            's2' => 'required',
            'tgl_lulus_s1' => 'required',
            'tgl_lulus_s2' => 'required',
            'ijazah_s1' => 'mimes:jpg,bmp,png',
            'ijazah_s2' => 'mimes:jpg,bmp,png',
            'bukti_terdaftar' => 'mimes:jpg,bmp,png',
        ],[
            'no_alb.required' => 'npwp tidak boleh kosong',
            's1.required' => 'S1 tidak boleh kosong',
            's2.required' => 'S2 tidak boleh kosong',
            'tgl_lulus_s1.required' => 'Tgl Lulus S1 tidak boleh kosong',
            'tgl_lulus_s2.required' => 'Tgl Lulus S2 tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;
            $ijazah_s1 = $request->ijazah_s1; 
            $ijazah_s2 = $request->ijazah_s2; 
            $bukti_terdaftar = $request->bukti_terdaftar;
            
            $data =  [
                'no_alb' => $request->no_alb,
                'tgl_lulus_s1' => $request->tgl_lulus_s1,
                'tgl_lulus_s2' => $request->tgl_lulus_s2,
                's1' => $request->s1,
                's2' => $request->s2,
            ];

            if(!empty($ijazah_s1)){
                $filename_ijazahs1 = $user_id.'-'.time().'.'.$ijazah_s1->getClientOriginalExtension();
                $data['ijazah_s1'] = $filename_ijazahs1;
                $ijazah_s1->move(public_path('upload/ijazah/s1'),$filename_ijazahs1);
            }
            if(!empty($ijazah_s1)){
                $filename_ijazahs2 = $user_id.'-'.time().'.'.$ijazah_s2->getClientOriginalExtension();
                $data['ijazah_s2'] = $filename_ijazahs2;
                $ijazah_s2->move(public_path('upload/ijazah/s2'),$filename_ijazahs2);
            }
            if(!empty($bukti_terdaftar)){
                $filename_bukti = $user_id.'-'.time().'.'.$bukti_terdaftar->getClientOriginalExtension();
                $data['bukti_terdaftar'] = $filename_bukti;
                $bukti_terdaftar->move(public_path('upload/bukti/'),$filename_bukti);
            }

            $detail = DetailALB::updateOrCreate(
                ['user_id' => $user_id],
                $data
            );  

            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Ubah Data Diri!']);
        } catch(Exception $e){
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
