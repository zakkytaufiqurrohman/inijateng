<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $user = User::find($user_id)->first();

        return view('notaris.data_diri', compact('user'));
    }

    public function data_diri_edit()
    {
        $user_id = Auth::id();
        $user = User::find($user_id)->first();

        return view('notaris.data_diri_edit', compact('user'));
    }
}
