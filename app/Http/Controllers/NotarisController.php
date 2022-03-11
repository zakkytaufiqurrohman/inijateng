<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\DetailNotaris;

class NotarisController extends Controller
{
    //
    public function index()
    {
        return '';
    }

    public function data_diri()
    {
        $user_id = Auth::id();
        // $user = User::find($user_id)->first();
        $user_id = Auth::id();
        $user = User::leftJoin('detail_notaris', function($join) {
            $join->on('users.id', '=', 'detail_notaris.user_id');
        })
        ->find($user_id);

        return view('notaris.data_diri', compact('user'));
    }

    public function data_diri_edit()
    {
        $user_id = Auth::id();
        $user = User::leftJoin('detail_notaris', function($join) {
            $join->on('users.id', '=', 'detail_notaris.user_id');
        })
        ->find($user_id);

        return view('notaris.data_diri_edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npwp' => 'required',
            'telephone' => 'required',
        ],[
            'npwp.required' => 'npwp tidak boleh kosong',
            'telephone.required' => 'No Telp tidak boleh kosong',
        ]);
        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;

            $data = DetailNotaris::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'npwp' => $request->npwp,
                    'telephone' => $request->telephone,
                    'alamat_kantor' => $request->alamat,
                    'no_kta_ini' => $request->no_kta_ini,
                    'no_kta_ppt' => $request->no_kta_ppt,
                ]
            );
            
            DB::commit();
            
            return response()->json(['status' => 'success', 'message' => 'Berhasil Ubah Data Diri!']);
        } catch(Exception $e){
            DB::rollback();

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
