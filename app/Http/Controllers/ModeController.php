<?php

namespace App\Http\Controllers;

use App\Support\Unique;
use Illuminate\Http\Request;
use DB;

class ModeController extends Controller
{
    //
    public function index (Request $request){}

    public function create (Request $request)
    {
        DB::table('admin')->find('D8C391C5FFA64075842D61F64EC23EDD');
        dump(DB::table('admin')->where('username','root')->select());
        return view('mode.create');
    }

    public function update (Request $request){}

    public function delete (Request $request){}
}
