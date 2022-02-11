<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use App\Http\Controllers\DependantDropdownController;
// use DataTables;

class RegisterCostumeController extends Controller
{
    //
    public function index()
    {
        $dependant = new DependantDropdownController;
        $provinces = $dependant::provinces();

        return view('auth.register',compact('provinces'));
    } 

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users',
            'nik' => 'required|unique:users|min:16|max:16',
            'npwp' => 'required',
            'no_telp' => 'required',
            'telp_kantor' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'password' => 'required|min:6',
            'password_confirm' => 'required_with:password|same:password|min:6'
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.min|nik.max' => 'NIK harus terdiri dari 16 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'npwp.required' => 'npwp tidak boleh kosong',
            'no_telp.required' => 'No Telp tidak boleh kosong',
            'telp_kantor.required' => 'Telp Kantor tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'provinsi.required' => 'Provinsi tidak boleh kosong',
            'kota.required' => 'Kota tidak boleh kosong',
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
