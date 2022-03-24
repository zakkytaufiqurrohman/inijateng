<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DependantDropdownController;
use App\Models\Alb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

}
