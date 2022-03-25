<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DependantDropdownController;
use App\Mail\RegisterAlb;
use App\Models\Alb;
use App\Models\AlbTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class AlbEventController extends Controller
{
    public function index(Request $request)
    {
        return view('Admin.alb.index');
    }

    public function eventAlb($id)
    {
        $dependant = new DependantDropdownController;
        $provinces = $dependant->provinces();
        return view('Admin.alb.register_alb',compact('id','provinces'));
    }

    public function registerAlb(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:alb_transactions,nama',
            'nik' => 'required|unique:alb_transactions,nik',
            'email' => 'required|unique:alb_transactions,email',
            'wa' => 'required|unique:alb_transactions,wa',
            'provinsi_lahir' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            's1' => 'required',
            's1_tahun' => 'required',
            's2' => 'required',
            's2_tahun' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png|max:2000',
            'ktp' => 'required|mimes:jpg,jpeg,png|max:2000',
            'bukti_bayar' => 'required|mimes:jpg,jpeg,png|max:2000',
            'ijazah_s1' => 'required|mimes:jpg,jpeg,png|max:2000',
            'ijazah_s2' => 'required|mimes:jpg,jpeg,png|max:2000',
            'suket' => 'required|mimes:pdf|max:2000',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.unique' => 'Nama sudah ada',
            'nik.required' => 'Nik tidak boleh kosong',
            'nik.unique' => 'Nik sudah ada',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada',
            'wa.required' => 'WhatsApp tidak boleh kosong',
            'wa.unique' => 'WhatsApp sudah ada',
            'provinsi_lahir.required' => 'Provinsi Tempat Lahir tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'nik.required' => 'Nik tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'kota.required' => 'kota tidak boleh kosong',
            's1.required' => 'Nama Perguruan Tinggi (S1) tidak boleh kosong',
            's1_tahun.required' => 'Tahun Perguruan Tinggi (S1) tidak boleh kosong',
            's2.required' => 'Nama Perguruan Tinggi (S2) tidak boleh kosong',
            's2_tahun.required' => 'Tahun Perguruan Tinggi (S2) tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
            'foto.required' => 'foto tidak boleh kosong',
            'suket.required' => 'suket tidak boleh kosong',
            'ijazah_s1.required' => 'Ijazah S1 tidak boleh kosong',
            'ijazah_s2.required' => 'Ijazah S2 tidak boleh kosong',
            'ktp.required' => 'Ktp tidak boleh kosong',
            'bukti_bayar.required' => 'Bukti Bayar tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try {
            $wa = $request->wa;
            if(substr($wa,0,1) == 0) {
                $wa = '62'.substr($wa, 1);
            }
            if(substr($wa,0,1) == '+') {
                $wa = substr($wa, 1);
            }
            // upload
            $ktp = $request->ktp;
            $bukti = $request->bukti_bayar;
            $ijazah_s1 =  $request->ijazah_s1;
            $ijazah_s2 =  $request->ijazah_s2;
            $foto =  $request->foto;
            $suket =  $request->suket;
            if(!empty($ktp)){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $nama_ktp = rand(10,100).time()."_".$text;
                $ktp->move(public_path('upload/alb_register'),$nama_ktp);
            }
            if(!empty($bukti)){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $nama_bukti = rand(10,100).time()."_".$text;
                $bukti->move(public_path('upload/alb_register'),$nama_bukti);
            }
            if(!empty($ijazah_s1)){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $nama_ijazah_s1 = rand(10,100).time()."_".$text;
                $ijazah_s1->move(public_path('upload/alb_register'),$nama_ijazah_s1);
            }
            if(!empty($ijazah_s2)){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $nama_ijazah_s2 = rand(10,100).time()."_".$text;
                $ijazah_s2->move(public_path('upload/alb_register'),$nama_ijazah_s2);
            }
            if(!empty($foto)){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $nama_foto = rand(10,100).time()."_".$text;
                $foto->move(public_path('upload/alb_register'),$nama_foto);
            }
            if(!empty($suket)){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $nama_suket = rand(10,100).time()."_".$text;
                $suket->move(public_path('upload/alb_register'),$nama_suket);
            }
            $user = AlbTransaction::create([
                'alb_id'=> $request->alb_id,
                'kode'=> $request->nik,
                'nama'=> $request->nama,
                'nik'=> $request->nik,
                'email'=> $request->email,
                'wa'=> $wa ,
                'tempat_lahir'=> $request->tempat_lahir,
                'tanggal_lahir'=> $request->tgl_lahir,
                'provinsi'=> $request->provinsi_lahir ,
                'kota'=> $request->kota,
                's1'=> $request->s1,
                'tahun_s1'=> $request->s1_tahun,
                's2'=> $request->s2,
                'tahun_s2'=> $request->s2_tahun,
                'foto'=> $nama_foto ,
                'suket'=> $nama_suket ,
                'ijazah_s1'=> $nama_ijazah_s1,
                'ijazah_s2'=> $nama_ijazah_s2,
                'ktp'=> $nama_ktp,
                'bukti_bayar'=> $nama_bukti,
                'bendahara_status'=> 0,
                'verifikator_status' => 0
            ]);

            DB::commit();
            $details = [
                'name' =>  $user->nama
            ];
            Mail::to($request->email)->send(new RegisterAlb($details));

            return response()->json(['status' => 'success', 'message' => 'Registrasi Berhasil','data'=> $user->nama]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function data()
    {
        $data = Alb::query();
        $data->orderBy('id', 'DESC');
        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {

                $action = '';
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$data->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";

                return $action;
            })
            ->addColumn('banner',function ($data) {
                $url= asset("upload/banner_alb/$data->banner");
                $foto = '';
                $foto .= "<img src=".$url." border='0' width='100' class='img' align='center' />'" ;

                return $foto;
            })
            ->addColumn('status', function ($data) {

                $status = 'Aktif';
                if($data->status == '0'){
                    $status = 'Tidak Aktif';
                }

                return $status;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|unique:albs,judul',
            'tahun' => 'required|unique:albs,year',
            'keterangan' => 'required',
            'banner' => 'required|mimes:jpg,bmp,png',
        ], [
            'judul.required' => 'Nama tidak boleh kosong',
            'judul.unique' => 'Nama sudah ada',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.unique' => 'Tahun sudah ada',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        $foto = $request->banner;
        $text = str_replace(' ', '',$foto->getClientOriginalName());
        $fotos = time()."_".$text;
        try {
            Alb::create([
                'judul' => $request->input('judul'),
                'year' => $request->input('tahun'),
                'status' => '0',
                'banner' => $fotos,
                'keterangan' => $request->input('keterangan'),
            ]);

            DB::commit();
            $foto->move(public_path('upload/banner_alb'),$fotos);

            return response()->json(['status' => 'success', 'message' => 'Berhasil menambahkan Role.']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $alb = Alb::find($id);
        if (!$alb) {
            return response()->json(['status' => 'error', 'message' => 'gagal mendapatkan data', 'data' => '']);
        }

        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data', 'data' => $alb]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'judul' => 'required|unique:albs,judul,'.$id,
            'tahun' => 'required|unique:albs,year,'.$id,
            'keterangan' => 'required',
            'status' => 'required',
            'banner' => 'mimes:jpg,bmp,png',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.unique' => 'Judul sudah ada',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.unique' => 'Tahun sudah ada',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        $alb = Alb::find($id);
        $unlink = 'unlink.png';
        $foto = $request->banner;
            $nama_foto = '';
            if($request->hasfile('banner')){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $fotos = time()."_".$text;
                $foto->move(public_path('upload/banner_alb'),$fotos);
                $nama_foto = $fotos;
                if (!empty($alb->banner)) {
                    $unlink = $alb->banner;
                }
                $image_path = public_path('upload/banner_alb/').$unlink;
                if (file_exists($image_path)){
                    unlink($image_path);
                }
            }
            else {
                $nama_foto = $alb->banner;
            }
        try {
            $alb->judul = $request->input('judul');
            $alb->year = $request->input('tahun');
            $alb->status = $request->input('status');
            $alb->banner = $nama_foto;
            $alb->keterangan = $request->input('keterangan');
            $alb->save();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil Mengubah ']);
        }
        catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            $unlink = 'defaul.png';
            $data = Alb::find($id);
            $ambil_foto_lama = $data->banner;
            if($data->status == '1')
            {
                return response()->json(['status' => 'error', 'message' => 'Event Masih Berlangsung']);
            }
            else{
                $data->delete();
                DB::commit();
                if (!empty($ambil_foto_lama)) {
                    $unlink = $ambil_foto_lama;
                }
                $image_path = public_path('upload/banner_alb/').$unlink;
                if (file_exists($image_path)){
                    unlink($image_path);
                }
                return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus data']);
            }

           
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function eventAlbSuccess($id)
    {
        return view('Admin.alb.register_success',compact('id'));
    }

}
