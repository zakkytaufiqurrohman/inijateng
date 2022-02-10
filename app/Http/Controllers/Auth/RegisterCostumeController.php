<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
// use DataTables;

class RegisterCostumeController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    } 

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'email' => 'required',
            // 'nik' => 'required|unique:users,nik,NULL,id,deleted_at,NULL',
            'nik' => 'required',
            'npwp' => 'required',
            'no_telp' => 'required',
            'telp_kantor' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required'
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'nik.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        DB::beginTransaction();
        try{

            $data = User::create([
                'name' => $request->nama,
                'nik' => $request->nik,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'npwp' => $request->npwp,
                'phone_number' => $request->no_telp,
                'office_number' => $request->telp_kantor,
                'alamat_kantor' => $request->alamat,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Pendaftaran Berhasil!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
