<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function readQr($id)
    {
        $id = $this->base64url_decode($id);
        // $data = User::where('nik',$id)->first();

        $data = User::leftJoin('detail_notaris', function($join) {
            $join->on('users.id', '=', 'detail_notaris.user_id');
        })
        ->where('nik',$id)->first();
        // dd($data);
        if(!$data){
            return 'data tidak di temukan';
        }
        return view('profile.preview',compact('data'));
    }

    function base64url_decode($b64Text)
    {
        return base64_decode(strtr($b64Text, '-_,','+='));
    }
}
