<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\DependantDropdownController;
use DB;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user_id =  Auth::user()->id;
        $user = User::find($user_id);

        $dependant = new DependantDropdownController;
        $provinces = $dependant->provinces();

        $provinsi_lahir = $dependant->searchBy('cities',$user->tempat_lahir)->province->id;
        $user['provinsi_lahir'] = $provinsi_lahir;

        return view('profile.index', compact('user','provinces'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'npwp' => 'required',
            'no_telp' => 'required',
            'telp_kantor' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.min|nik.max' => 'NIK harus terdiri dari 16 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
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
            $user = User::find(Auth::user()->id);

            $data = $user->update([
                'name' => $request->nama,
                'nik' => $request->nik,
                'email' => $request->email,
                'npwp' => $request->npwp,
                'phone_number' => $request->no_telp,
                'office_number' => $request->telp_kantor,
                'tgl_lahir' => $request->tgl_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'alamat_kantor' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Ubah Profil!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update_password(Request $request)
    {
        if(bdecrypt($request->recent_password)!=Auth::user()->password){
            return response()->json(['status' => 'error', 'message' => 'Password anda salah']);
        }
        $validated = $request->validate([
            'password' => 'required|min:6',
            'password_confirm' => 'required_with:password|same:password|min:6'
        ],[
            'password.required' => 'Password tidak boleh kosong',
            'kota.required' => 'Kota tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try{
            $user = User::find(Auth::user()->id);

            $data = $user->update([
                'password' => bcrypt($request->password)
            ]);
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Ubah Password!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
