<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){
        $sejarah = DB::table('arf_about')->where('id',1)->first();
        $visi = DB::table('arf_about')->where('id',2)->first();
        $kode_etk = DB::table('arf_about')->where('id',5)->first();
        return view('page.home',compact('sejarah','visi','kode_etk'));
    }
   
}
