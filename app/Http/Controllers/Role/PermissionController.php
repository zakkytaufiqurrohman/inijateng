<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;
use Exception;
use Yajra\DataTables\Facades\DataTables;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:all');
    }

    public function index(Request $request)
    {
        return view('permission.index');
    }

    public function data()
    {
        $data = Permission::query();
        $data->orderBy('id', 'DESC');
        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {

                $action = '';
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-primary' data-id='{$data->id}' onclick='edit(this);'><i class='fa fa-edit'></i></a>&nbsp;";
                $action .= "<a href='javascript:void(0)' class='btn btn-icon btn-danger'  data-id='{$data->id}' onclick='Delete(this);'><i class='fa fa-trash'></i></a>&nbsp;";

                return $action;
            })
            // ->addColumn('permission', function ($data) {

            //     $permission = '';
            //     $permissions = $data->permissions();
            //     if ($permissions->count() > 0) {
            //         foreach ($permissions->get() as $key => $data) {
            //             $permission .= ($key + 1) . ". " . $data->name . "<br>";
            //         }
            //     }

            //     return $permission;
            // })
            ->escapeColumns([])
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'keterangan' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah ada',
            'keterangan.required' => 'Keterangan tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {
            Permission::create([
                'name' => $request->input('name'),
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
        $role = Permission::find($id);
        if (!$role) {
            return response()->json(['status' => 'error', 'message' => 'gagal mendapatkan data', 'data' => '']);
        }

        return response()->json(['status' => 'success', 'message' => 'Berhasil mengambil data', 'data' => $role]);
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
            'name' => 'required|unique:permissions,name,'.$id,
            'keterangan' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah ada',
            'keterangan.required' => 'Keterangan tidak boleh kosong'
        ]);
        DB::beginTransaction();
        try {

            $permission = Permission::find($id);
            $permission->name = $request->input('name');
            $permission->keterangan = $request->input('keterangan');
            $permission->save();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil Mengubah Permission']);
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
            DB::table("permissions")->where('id', $id)->delete();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Berhasil menghapus data']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
