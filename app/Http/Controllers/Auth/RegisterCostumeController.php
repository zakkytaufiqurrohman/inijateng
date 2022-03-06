<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\Auth\LoginCustomeController;
// use DataTables;

class RegisterCostumeController extends Controller
{
    //
    public function index()
    {
        $dependant = new DependantDropdownController;
        $provinces = $dependant->provinces();
        // $provinces = $dependant::provinces();

        return view('auth.register2',compact('provinces'));
    } 

    public function check_user(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required'
        ],[
            'nik.required' => 'NIK Masih Kosong'
        ]);

        try {
            $user = User::where('nik',$request->nik)->first();
            if(!$user){
                return response()->json(['status' => 'error', 'message' => 'NIK Belum Terdaftar, harap hubungi admin']);
            }
            $user['is_check'] = (!empty($user->password)) ? 1 : 0;
            
            return response()->json(['status' => 'success', 'message' => $user]);
        } catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirm' => 'required_with:password|same:password|min:6'
        ],[
            'user_id.required' => 'ID tidak ada',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        DB::beginTransaction();
        try{

            $user = User::where('id',$request->user_id)->first();
            $update = $user->update([
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            DB::commit();
            
            $request->merge([
                'nik' => $user->nik
            ]);
            
            $login = new LoginCustomeController;
            $login->login($request);

            return response()->json(['status' => 'success', 'message' => 'Pendaftaran Berhasil!']);
        } catch(Exception $e){

            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
