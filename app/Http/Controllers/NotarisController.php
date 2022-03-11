<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\DetailNotaris;

class NotarisController extends Controller
{
    //
    public function index()
    {
        return '';
    }

    public function data_diri()
    {
        $user_id = Auth::id();
        // $user = User::find($user_id)->first();
        $user_id = Auth::id();
        $user = User::leftJoin('detail_notaris', function($join) {
            $join->on('users.id', '=', 'detail_notaris.user_id');
        })
        ->find($user_id);

        return view('notaris.data_diri', compact('user'));
    }

    public function data_diri_edit()
    {
        $user_id = Auth::id();
        $user = User::leftJoin('detail_notaris', function($join) {
            $join->on('users.id', '=', 'detail_notaris.user_id');
        })
        ->find($user_id);

        return view('notaris.data_diri_edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npwp' => 'required',
            'telephone' => 'required',
            'ktp_img' => 'mimes:jpg,bmp,png',
            'sk_notaris' => 'mimes:pdf',
            'sk_ppt' => 'mimes:pdf',
            'scan_npwp' => 'mimes:jpg,bmp.png',
        ],[
            'npwp.required' => 'npwp tidak boleh kosong',
            'telephone.required' => 'No Telp tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;
            
            $ktp = $request->ktp_img;
            $sk_notaris = $request->sk_notaris;
            $sk_ppt = $request->sk_ppt;
            $scan_npwp = $request->scan_npwp;

            $data =  [
                'npwp' => $request->npwp,
                'telephone' => $request->telephone,
                'alamat_kantor' => $request->alamat,
                'no_kta_ini' => $request->no_kta_ini,
                'no_kta_ppt' => $request->no_kta_ppt,
            ];

            if(!empty($ktp)){
                $filename_ktp = $user_id.'-'.time().'.'.$ktp->getClientOriginalExtension();
                $data['ktp_img'] = $filename_ktp;
                $ktp->move(public_path('upload/ktp_img'),$filename_ktp);
            }
            if(!empty($sk_notaris)){
                $filename_skn = $user_id.'-'.time().'.'.$sk_notaris->getClientOriginalExtension();
                $data['sk_notaris'] = $filename_skn;
                $sk_notaris->move(public_path('upload/sk_notaris'),$filename_skn);
            }
            if(!empty($sk_ppt)){
                $filename_skp = $user_id.'-'.time().'.'.$sk_ppt->getClientOriginalExtension();
                $data['sk_ppt'] = $filename_skp;
                $sk_ppt->move(public_path('upload/sk_ppt'),$filename_skp);
            }
            if(!empty($scan_npwp)){
                $filename_snpwp = $user_id.'-'.time().'.'.$scan_npwp->getClientOriginalExtension();
                // $data['ktp_img'] = $filename_snpwp;
                $scan_npwp->move(public_path('upload/scan_npwp'),$filename_snpwp);
            }
            
            $detail = DetailNotaris::updateOrCreate(
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
