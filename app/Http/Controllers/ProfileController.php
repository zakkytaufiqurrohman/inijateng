<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user_id =  Auth::user()->id;
        $user = User::find($user_id);

        return view('profile.index', compact('user'));
    }
}
