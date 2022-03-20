<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMaber;
use App\Models\Magber;
use App\Models\MagberTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class MagberController extends Controller
{
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
            'tahun' => 'required|unique:magbers,year',
            'keterangan' => 'required'
        ], [
            'judul.required' => 'Nama tidak boleh kosong',
            'judul.unique' => 'Nama sudah ada',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.unique' => 'Tahun sudah ada',
            'keterangan.required' => 'Keterangan tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {
            Magber::create([
                'judul' => $request->input('judul'),
                'year' => $request->input('tahun'),
                'status' => '0',
                'keterangan' => $request->input('keterangan'),
            ]);

            DB::commit();
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
            'tahun' => 'required|unique:magbers,year,'.$id,
            'keterangan' => 'required',
            'status' => 'required'
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.unique' => 'Judul sudah ada',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.unique' => 'Tahun sudah ada',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {

            $maber = Magber::find($id);
            $maber->judul = $request->input('judul');
            $maber->year = $request->input('tahun');
            $maber->status = $request->input('status');
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
            $data = Magber::find($id);
            if($data->status == '1')
            {
                return response()->json(['status' => 'error', 'message' => 'Event Masih Berlangsung']);
            }
            else{
                $data->delete();
                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus data']);
            }

           
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function eventMagber($id)
    {
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
            'bukti_bayar' => 'mimes:jpg,bmp,png|max:10000',
        ], [
            'nik.required' => 'nik tidak boleh kosong',
            'semester.required' => 'semester tidak boleh kosong',
            'bukti_bayar.required' => 'bukti bayar tidak boleh kosong',
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        $user = User::where('nik',$request->nik)->first();

        $foto = $request->bukti_bayar;
        $text = str_replace(' ', '',$foto->getClientOriginalName());
        $fotos = time()."_".$text;
        $nama_foto = $fotos;
        try {
            MagberTransaction::create([
                'user_id' => $user->id,
                'magber_id' => $request->event_id,
                'magber_ke' => $request->semester,
                'bukti_bayar' => $fotos,
                'bendahara_status' => 0,
                'bendahara_status' => 0,
            ]);

            DB::commit();
            $foto->move(public_path('upload/bukti_bayar_maber'),$fotos);
            return response()->json(['status' => 'success', 'message' => 'Pendaftaran Berhasil','data'=>$user->name]);
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
        if(empty($user->wa)){
            return response()->json(['status' => 'error', 'message' => 'Data Belum Lengkap']);
        }

        //cek apakah sudah mendaftar cari di transaksi param nik dan maber ke berapa
        $is_record = MagberTransaction::where('user_id',$user->id)->where('magber_ke',$request->semester)->first();
        if(!empty($is_record)){
            return response()->json(['status' => 'ready', 'message' => 'Data Sudah Ada']);
        }

        $details = [
            'name' =>  $user->name
        ];
        // send email 
        Mail::to($user->email)->send(new RegisterMaber($details));
    
        return response()->json(['status' => 'success', 'message' => 'Berhasil']);
       
    }


}
