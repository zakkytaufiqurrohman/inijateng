<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\DB as FacadesDB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class MasterDataController extends Controller
{
    function __construct()
    {
        // $this->middleware('role:admin');
        $this->middleware('permission:all');
    }

    public function index()
    {
        $roles = Role::all();
        return view('master_data.index', compact('roles'));
    }

    public function data(Request $request)
    {
        $data = User::query();
        if ($request->id) {
            $data->where('status_anggota', $request->id);
        }
        $data->orderBy('id', 'DESC');
        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {

                $action = '';
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$data->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";

                return $action;
            })
            ->addColumn('barcode', function ($data) {
                if ($data->status_anggota == 'notaris') {
                    $kode = $data->nik;
                    $kode = $this->base64url_encode($kode);
                    $kode =  config('app.url') . '/barcode/' . $kode;
                    // generate barcode
                    $images = \DNS2D::getBarcodePNGPath($kode, 'QRCODE', 5, 5);
                    // get image patch
                    $nameImage = $images;
                    $nameImage = str_replace("/barcode", "", $nameImage);
                    $url = asset("barcode/$nameImage");

                    $barcode = '';
                    $barcode .= "<a href='master_data/download$nameImage'><img src=" . $url . " border='0' width='100' class='img' align='center' />'</a>";

                    return $barcode;
                }
            })
            ->editColumn('roles', function ($row) {
                $roles = '';
                if (!empty($row->getRoleNames())) {
                    foreach ($row->getRoleNames() as $role) {
                        $roles .= "<label class='badge badge-primary'>{$role}</label>&nbsp;";
                    }
                }
                return $roles;
            })
            ->addColumn('status', function ($data) {
                if ($data->status_anggota == 'notaris') {
                    $status = "<label class='badge badge-warning'>Belum Lengkap</label>&nbsp;";
                    $datas = DB::table('v_notaris_count')->where('id', $data->id)->first();
                    if ($datas->empty_count == 0) {
                        $status = "<label class='badge badge-success'>Sudah Lengkap</label>&nbsp;";
                    }
                    return $status;
                }
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'nik' => 'required|unique:users,nik|digits:16',
            'email' => 'required|unique:users,email',
            'status_anggota' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah ada',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah ada',
            'nik.digits' => 'NIK harus 16 digits',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada',
            'status_anggota.required' => 'Status anggota tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try {
            $data = User::create([
                'name' => $request->input('name'),
                'nik' => $request->input('nik'),
                'email' => $request->input('email'),
                'status_anggota' => $request->input('status_anggota'),
            ]);
            $data->assignRole($request->role);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil menambahkan Data']);
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
        $data = User::find($id);
        $data->roles;
        if (!$data) {
            return response()->json(['status' => 'error', 'message' => 'gagal mendapatkan data', 'data' => '']);
        }

        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data', 'data' => $data]);
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
            'name' => 'required|unique:users,name,' . $id,
            'nik' => 'required|digits:16|unique:users,nik,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'status_anggota' => 'required',
            'roleEdit' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah ada',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah ada',
            'nik.digits' => 'NIK harus 16 digits',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada',
            'status_anggota.required' => 'Status anggota tidak boleh kosong',
            'roleEdit.required' => 'Role tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try {

            $user = User::find($id);
            $user->name = $request->input('name');
            $user->nik = $request->input('nik');
            $user->email = $request->input('email');
            $user->status_anggota = $request->input('status_anggota');
            $user->save();

            $user->syncRoles($request->roleEdit);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil Mengubah Permission']);
        } catch (Exception $e) {
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
            DB::table("users")->where('id', $id)->delete();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus data']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function download($filepath)
    {
        $url =  public_path() . '/barcode/' . $filepath;
        return \Response::download($url);
    }

    function base64url_encode($plainText)
    {
        return strtr(base64_encode($plainText), '+=', '-_,');
    }

    function base64url_decode($b64Text)
    {
        return base64_decode(strtr($b64Text, '-_,', '+='));
    }
}
