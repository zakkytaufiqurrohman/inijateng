<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProfileController extends Controller
{
    
    public function index()
    {
        return view('FrontPage.profile.index');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->validate($request,[
            'judul' => 'required|min:2|max:255',
            'flag' => 'required',
            'status' => 'required',
            'isi' =>'required|min:2',
        ],[
           'judul.required'=>'judul Tidak Boleh Kosong',
           'status.required'=>'Status Tidak Boleh Kosong',
           'flag.required'=>'flag Tidak Boleh Kosong',
           'judul.min'=>'judul minimal 2 character',
           'isi.min'=>'Isi minimal 2 character',
        ]);
        DB::beginTransaction();
        $foto = $request->foto;
        try{
            if(!empty($foto)){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $filename_foto = time()."_".$text;
            }
            $data = Profile::create([
                'judul' => $request->judul,
                'foto' => $filename_foto,
                'isi' => $request->isi,
                'flag' => $request->flag,
                'status' => $request->status,
            ]);
            $foto->move(public_path('upload/FrontPage/profile'),$filename_foto);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil menambahkan data']);
        } catch(Exception $e){
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->validate($request,[
            'judul' => 'required|min:2|max:255',
            'flag' => 'required',
            'status' => 'required',
            'isi' =>'required|min:2',
        ],[
           'judul.required'=>'judul Tidak Boleh Kosong',
           'status.required'=>'Status Tidak Boleh Kosong',
           'flag.required'=>'flag Tidak Boleh Kosong',
           'judul.min'=>'judul minimal 2 character',
           'isi.min'=>'Isi minimal 2 character',
        ]);

        DB::beginTransaction();
        $profile = Profile::find($request->id);
        try{
            $foto = $request->foto;
            $nama_foto = '';
            if($request->hasfile('foto')){
                $text = str_replace(' ', '',$foto->getClientOriginalName());
                $fotos = time()."_".$text;
                $foto->move(public_path('upload/FrontPage/profile'),$fotos);
                $nama_foto = $fotos;
            }
            else {
                $nama_foto = $profile->foto;
            }
            $ambil_foto_lama = $profile->foto;
            $profile->update([
               'judul' => $request->judul,
               'isi' =>$request->isi,
               'flage' =>$request->flage,
               'status' =>$request->status,
               'foto' => $nama_foto
            ]);
            DB::commit();

            $image_path = public_path('upload/FrontPage/profile/').$ambil_foto_lama;
            if (file_exists($image_path)){
                unlink($image_path);
            }
            
            return response()->json(['status' => 'success', 'message' => $image_path]);
        } catch(Exception $e){
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function show(Request $request)
    {
        $datas = Profile::find($request->id);
        if (!$datas) {
            return response()->json(['status' => 'error', 'message' => 'data tidak ditemukan', 'data' => '']);
        }

        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data', 'data' => $datas]);
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = Profile::find($request->id);
            $ambil_foto_lama = $data->foto;
            $data->delete();
            DB::commit();
            $image_path = public_path('upload/FrontPage/profile/').$ambil_foto_lama;
            if (file_exists($image_path)){
                unlink($image_path);
            }
            return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus Data']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function data(Request $request)
    {

        $data = Profile::query();
        $data->orderBy('created_at','DESC');

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
               
                $action = '';
                    $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='showCovernot(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                    $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$data->id}' onclick='deleteData(this);'><i class='fa fa-trash'></i></a>&nbsp;";
                return $action;
            })
            
            ->addColumn('foto',function ($data) {
                $url= asset("upload/FrontPage/profile/$data->foto");
                $foto = '';
                $foto .= "<img src=".$url." border='0' width='100' class='img' align='center' />'" ;

                return $foto;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }
}
