<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\DetailAlb;
use App\Models\DetailBerkasAlb;
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

        return view('Admin.alb.data_diri_edit', compact('user'));
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
                $data['ijazah_s1'] = $this->move_file($ijazah_s1,'ijazah_s1','upload/ijazah/s1');
            }
            if(!empty($ijazah_s1)){
                $data['ijazah_s2'] = $this->move_file($ijazah_s2,'ijazah_s2','upload/ijazah/s2');
            }
            if(!empty($bukti_terdaftar)){
                $data['bukti_terdaftar'] = $this->move_file($bukti_terdaftar,'ijazah_s2','upload/bukti');
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

    public function berkas()
    {
        $user_id = Auth::id();
        $user = User::leftJoin('detail_berkas_alb', function($join) {
            $join->on('users.id', '=', 'detail_berkas_alb.user_id');
        })
        ->find($user_id);
        
        return view('Admin.alb.berkas', compact('user'));
    }

    public function berkas_edit()
    {
        $user_id = Auth::id();
        $user = User::leftJoin('detail_berkas_alb', function($join) {
            $join->on('users.id', '=', 'detail_berkas_alb.user_id');
        })
        ->find($user_id);
        
        return view('Admin.alb.berkas_edit', compact('user'));
    }

    public function store_berkas(Request $request)
    {
        $validated = $request->validate([
            'ktp' => 'mimes:jpg,bmp,png',
            'suket_pengda' => 'mimes:jpg,bmp,png',
            'pengantar_magang' => 'mimes:jpg,bmp,png',
            'rekomendasi_pengda' => 'mimes:jpg,bmp,png',
            'ttmb1' => 'mimes:jpg,bmp,png',
            'ttmb2' => 'mimes:jpg,bmp,png',
            'ttmb3' => 'mimes:jpg,bmp,png',
            'ttmb4' => 'mimes:jpg,bmp,png',
        ],[
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;
            $ktp = $request->ktp;
            $suket_pengda = $request->suket_pengda;
            $pengantar_magang = $request->pengantar_magang;
            $rekomendasi_pengda = $request->rekomendasi_pengda;
            $ttmb1 = $request->ttmb1;
            $ttmb2 = $request->ttmb2;
            $ttmb3 = $request->ttmb3;
            $ttmb4 = $request->ttmb4;

            $data = [];
            if(!empty($ktp)){
                $data['ktp'] = $this->move_file($ktp,'ktp','upload/ktp_img');
            }
            if(!empty($suket_pengda)){
                $data['suket_pengda'] = $this->move_file($suket_pengda,'ktp','upload/suket_pengda');
            }
            if(!empty($pengantar_magang)){
                $data['pengantar_magang'] = $this->move_file($pengantar_magang,'pengantar_magang','upload/pengantar_magang');
            }
            if(!empty($rekomendasi_pengda)){
                $data['rekomendasi_pengda'] = $this->move_file($rekomendasi_pengda,'rekomendasi_pengda','upload/rekomendasi_pengda');
            }
            if(!empty($ttmb1)){
                $data['ttmb1'] = $this->move_file($ttmb1,'ttmb1','upload/ttmb/1');
            }
            if(!empty($ttmb2)){
                $data['ttmb2'] = $this->move_file($ttmb2,'ttmb2','upload/ttmb/2');
            }
            if(!empty($ttmb3)){
                $data['ttmb3'] = $this->move_file($ttmb3,'ttmb3','upload/ttmb/3');
            }
            if(!empty($ttmb4)){
                $data['ttmb4'] = $this->move_file($ttmb4,'ttmb4','upload/ttmb/4');
            }

            if(!empty($data)){
                $detail = DetailBerkasAlb::updateOrCreate(
                    ['user_id' => $user_id],
                    $data
                );  
            }

            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Simpan Berkas!']);
        } catch(Exception $e){
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function move_file($file,$name,$dir,$old_filename=NULL)
    {
        $name = str_replace(' ', '',$file->getClientOriginalName());
        $filename = rand(10,100).time()."_".$name;
        $file->move(public_path($dir),$filename);

        return $filename;
    }
}
