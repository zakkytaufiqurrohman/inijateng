<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\DependantDropdownController;
use DB;
use Hash;

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
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.min|nik.max' => 'NIK harus terdiri dari 16 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'no_telp.required' => 'No Telp tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
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
                'wa' => $request->no_telp,
                'tgl_lahir' => $request->tgl_lahir,
                'tempat_lahir' => $request->tempat_lahir,
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
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json(['status' => 'error', 'message' => 'Password anda salah']);
        }
        $validated = $request->validate([
            'password' => 'required|min:6',
            'password_confirm' => 'required_with:password|same:password'
        ],[
            'password.required' => 'Password tidak boleh kosong',
            'password_confirm.required' => 'Konfirmasi Password tidak boleh kosong',
            'password_confirm.same' => 'Konfirmasi Password tidak sesuai',
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

    public function update_photo(Request $request)
    {
        $validated = $request->validate([
            'photo_img' => 'mimes:jpg,bmp,png',
        ],[
            '*.mimes' => 'Format tidak sesuai, periksa kembali',
        ]);
        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;
            $user = User::find($user_id);
            $foto = $request->photo_img;

            if(!empty($foto)){
                $filename_foto = $user_id.'-'.time().'.'.$foto->getClientOriginalExtension();

                $data = $user->update([
                    'foto' => $filename_foto
                ]);
                $foto->move(public_path('upload/foto'),$filename_foto);
            }

            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Ubah Foto!']);
        } catch(Exception $e){
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
