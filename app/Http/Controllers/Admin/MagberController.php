<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMaber;
use App\Models\Magber;
use App\Models\MagberTransaction;
use App\Models\RiwayatTTMB;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class MagberController extends Controller
{
    function __construct()
    {
        // $this->middleware('role:admin');
        $this->middleware('role:admin',['only' => ['index']]);
    }

    public function index(Request $request)
    {
        return view('Admin.magber.index');
    }

    public function data()
    {
        $data = Magber::query();
        $data->orderBy('id', 'DESC');
        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {

                $action = '';
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$data->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";

                return $action;
            })
            ->addColumn('banner',function ($data) {
                $url= asset("upload/banner_magber/$data->banner");
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
            'judul' => 'required|unique:magbers,judul',
            'start_date' => 'required',
            'end_date' => 'required',
            'keterangan' => 'required',
            'banner' => 'required|mimes:jpg,bmp,png|max:30000',
        ], [
            'judul.required' => 'Nama tidak boleh kosong',
            'judul.unique' => 'Nama sudah ada',
            'start_date.required' => 'start_date tidak boleh kosong',
            'end_date.required' => 'end_date tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        $foto = $request->banner;
        $text = str_replace(' ', '',$foto->getClientOriginalName());
        $fotos = time()."_".$text;
        try {
            Magber::create([
                'judul' => $request->input('judul'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => '0',
                'banner' => $fotos,
                'keterangan' => $request->input('keterangan'),
                'link_group' => $request->input('link_group'),
            ]);

            DB::commit();
            $foto->move(public_path('upload/banner_magber'),$fotos);

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
        $magber = Magber::find($id);
        if (!$magber) {
            return response()->json(['status' => 'error', 'message' => 'gagal mendapatkan data', 'data' => '']);
        }

        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data', 'data' => $magber]);
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
            'judul' => 'required|unique:magbers,judul,'.$id,
            'start_date' => 'required',
            'end_date' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'banner' => 'mimes:jpg,bmp,png|max:30000',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.unique' => 'Judul sudah ada',
            'start_date.required' => 'start_date tidak boleh kosong',
            'end_date.required' => 'end_date tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        $maber = Magber::find($id);
        $unlink = 'unlink.png';
        $foto = $request->banner;
            $nama_foto = '';
            if($request->hasfile('banner')){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $fotos = time()."_".$text;
                $foto->move(public_path('upload/banner_magber'),$fotos);
                $nama_foto = $fotos;
                if (!empty($maber->banner)) {
                    $unlink = $maber->banner;
                }
                $image_path = public_path('upload/banner_magber/').$unlink;
                if (file_exists($image_path)){
                    unlink($image_path);
                }
            }
            else {
                $nama_foto = $maber->banner;
            }
        try {
            $maber->judul = $request->input('judul');
            $maber->start_date = $request->start_date;
            $maber->end_date = $request->end_date;
            $maber->link_group = $request->link_group;
            $maber->status = $request->input('status');
            $maber->banner = $nama_foto;
            $maber->keterangan = $request->input('keterangan');
            $maber->save();

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
            $data = Magber::find($id);
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
                $image_path = public_path('upload/banner_magber/').$unlink;
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

    public function eventMagber($id)
    {
        $now = date('Y-m-d');
        $cek = Magber::where('start_date','<=',$now)->where('end_date','>=',$now)->where('status','1')->where('id',$id)->first();
        if(empty($cek)){
            return view('event_close');
        }
        return view('Admin.magber.event_magber',compact('id'));
    }

    public function eventMagberSuccess($id)
    {
        return view('Admin.magber.register_success',compact('id'));
    }


    public function eventMagberStore(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required',
            'semester' => 'required',
            'bukti_bayar' => 'required|mimes:jpg,bmp,png|max:20000',
        ], [
            'nik.required' => 'nik tidak boleh kosong',
            'semester.required' => 'semester tidak boleh kosong',
            'bukti_bayar.required' => 'bukti bayar tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
            'bukti_bayar.max' => 'Maksimal 2 Mb'
        ]);

        $user = User::where('nik',$request->nik)->first();
        if(empty($user)){
            return response()->json(['status' => 'error', 'message' => 'Data Tidak Di Temukan']);
        }
        //cek ttmb
        if($request->semester != '1'){
            $where_ttmb = '1';
            if($request->semester == '2') {
                $where_ttmb = '1';
            }
            if($request->semester == '3') {
                $where_ttmb = '2';
            }
            if($request->semester == '4') {
                $where_ttmb = '3';
            }

            $cek_ttmb = RiwayatTTMB::where('magang_ke',$where_ttmb)->where('user_id',$user->id)->count();
            if($cek_ttmb == 0){
                return response()->json(['status' => 'error', 'message' => 'Data Belum Lengkap']);
            }
        }
        $cek = DB::table('v_alb_count')->where('id',$user->id)->first();
        if($cek->empty_count != 0){
            return response()->json(['status' => 'error', 'message' => 'Data Belum Lengkap']);
        }

        $is_record = MagberTransaction::where('user_id',$user->id)->where('magber_ke',$request->semester)->first();
        if(!empty($is_record)){
            return response()->json(['status' => 'ready', 'message' => 'Data Sudah Ada']);
        }
       
        DB::beginTransaction();
        $user = User::where('nik',$request->nik)->first();

        $foto = $request->bukti_bayar;
        $text = str_replace(' ', '',$foto->getClientOriginalName());
        $fotos = time()."_".$text;

        //nomor
        $nomor = 1;
        $max = MagberTransaction::where('magber_ke',$request->semester)->orderBy('nomor','desc')->first();
        if($max->magber_id == $request->event_id){
            $nomor = $max->nomor + 1;
        }

        try {
            $datas = MagberTransaction::create([
                'user_id' => $user->id,
                'magber_id' => $request->event_id,
                'magber_ke' => $request->semester,
                'bukti_bayar' => $fotos,
                'bendahara_status' => 0,
                'bendahara_status' => 0,
                'kode' => $user->nik,
                'nomor' => $nomor
            ]);

            $foto->move(public_path('upload/bukti_bayar_maber'),$fotos);

            DB::commit();
            $details = [
                'name' =>  $datas->name,
                'link' => route('magber.id_card',$datas->kode)
            ];
            Mail::to($user->email)->send(new RegisterMaber($details));

            return response()->json(['status' => 'success', 'message' => 'Pendaftaran Berhasil','data'=>$user->name]);
            // send email 
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function eventMagberCheck(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required',
            'semester' => 'required',
        ], [
            'nik.required' => 'Nik tidak boleh kosong',
            'semester.required' => 'Semester tidak boleh kosong',
        ]);

        //cek apakah atribut nya lengkap param nik
        $user = User::where('nik',$request->nik)->first();
        if(empty($user)){
            return response()->json(['status' => 'error', 'message' => 'Data Tidak Di Temukan']);
        }
        $cek = DB::table('v_alb_count')->where('id',$user->id)->first();
        if($cek->empty_count != 0){
            return response()->json(['status' => 'error', 'message' => 'Data Belum Lengkap']);
        }

        //cek apakah sudah mendaftar cari di transaksi param nik dan maber ke berapa
        $is_record = MagberTransaction::where('user_id',$user->id)->where('magber_ke',$request->semester)->first();
        if(!empty($is_record)){
            return response()->json(['status' => 'ready', 'message' => 'Data Sudah Ada']);
        }
    
        return response()->json(['status' => 'success', 'message' => 'Berhasil']);
       
    }

    public function eventMagberIdCard($id)
    {
        $event = Magber::where('status','1')->first();
       
        $data = MagberTransaction::leftJoin('users','users.id','magber_transactions.user_id')->where('bendahara_status','1')->where('verifikasi_status','1')->where('magber_id',$event->id)->where('nik',$id)->first();
        if(!empty($data)){
            return view('Admin.magber.id_card',compact('data','event'));
        }
        else {
            return view('unferivied',compact('event'));
        }
        
    }


}
