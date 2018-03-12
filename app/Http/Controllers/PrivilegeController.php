<?php

namespace App\Http\Controllers;

use App\Model\Mode;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    //
    public function index (Request $request)
    {
        return view('privilege.index');
    }

    public function create (Request $request)
    {
        $modes = Mode::where('status','=','1')->get();

        return view('privilege.create',[
            'handle'        =>      'create',
            'modes'         =>      $modes,
        ]);
    }
}
