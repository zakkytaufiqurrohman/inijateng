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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penerima_magang' => 'required',
            'tempat_magang' => 'required',
            'wilayah_kerja' => 'required',
            'masa_magang' => 'required',
            'tgl_no_surat' => 'required',
            'magang_ke' => 'required',
        ],[
            '*.required' => 'tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;

            $data = RiwayatMagang::create([
                'user_id' => $user_id,
                'penerima_magang' => $request->penerima_magang,
                'tempat_magang' => $request->tempat_magang,
                'wilayah_kerja' => $request->wilayah_kerja,
                'masa_magang' => $request->masa_magang,
                'tgl_no_surat' => $request->tgl_no_surat,
                'magang_ke' => $request->magang_ke,
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Simpan Riwayat Magang!']);
        } catch(Exception $e){
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $data = RiwayatMagang::find($id);

        if (!$data) {
            return response()->json(['status' => 'error', 'message' => 'gagal mendapatkan data', 'data' => '']);
        }

        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data', 'data' => $data]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validated = $request->validate([
            'penerima_magang' => 'required',
            'tempat_magang' => 'required',
            'wilayah_kerja' => 'required',
            'masa_magang' => 'required',
            'tgl_no_surat' => 'required',
            'magang_ke' => 'required',
        ],[
            '*.required' => 'tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try{

            $data = RiwayatMagang::find($id);
            $update = $data->update([
                'penerima_magang' => $request->penerima_magang,
                'tempat_magang' => $request->tempat_magang,
                'wilayah_kerja' => $request->wilayah_kerja,
                'masa_magang' => $request->masa_magang,
                'tgl_no_surat' => $request->tgl_no_surat,
                'magang_ke' => $request->magang_ke
            ]);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil Update Riwayat Magang!']);
        } catch(Exception $e){
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            $data = RiwayatMagang::find($id)->delete();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus data']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function data_ttmb()
    {
        $user_id = Auth::user()->id;
        $data = RiwayatTTMB::where('user_id',$user_id)->orderBy('id','DESC');

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {

                $action = '';
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='editTTMB(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$data->id}' onclick='DeleteTTMB(this);'><i class='fa fa-trash'></i></a>&nbsp;";

                return $action;
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function store_ttmb(Request $request)
    {
        $validated = $request->validate([
            'pengwil' => 'required',
            'tgl_pelaksanaan' => 'required',
            'materi' => 'required',
            'nilai' => 'required',
            'tgl_nomor' => 'required',
            'magang_ke' => 'required',
        ],[
            '*.required' => 'tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;

            $data = RiwayatTTMB::create([
                'user_id' => $user_id,
                'pengwil' => $request->pengwil,
                'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
                'materi' => $request->materi,
                'nilai' => $request->nilai,
                'tgl_nomor' => $request->tgl_nomor,
                'magang_ke' => $request->magang_ke,
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Simpan Riwayat TTMB!']);
        } catch(Exception $e){
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function show_ttmb(Request $request)
    {
        $id = $request->id;
        $data = RiwayatTTMB::find($id);

        if (!$data) {
            return response()->json(['status' => 'error', 'message' => 'gagal mendapatkan data', 'data' => '']);
        }

        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data', 'data' => $data]);
    }

    public function update_ttmb(Request $request)
    {
        $id = $request->id;
        $validated = $request->validate([
            'pengwil' => 'required',
            'tgl_pelaksanaan' => 'required',
            'materi' => 'required',
            'nilai' => 'required',
            'tgl_nomor' => 'required',
            'magang_ke' => 'required',
        ],[
            '*.required' => 'tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try{

            $data = RiwayatTTMB::find($id);
            $update = $data->update([
                'pengwil' => $request->pengwil,
                'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
                'materi' => $request->materi,
                'nilai' => $request->nilai,
                'tgl_nomor' => $request->tgl_nomor,
                'magang_ke' => $request->magang_ke,
            ]);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil Update Riwayat TTMB!']);
        } catch(Exception $e){
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy_ttmb(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            $data = RiwayatTTMB::find($id)->delete();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus data']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
}
