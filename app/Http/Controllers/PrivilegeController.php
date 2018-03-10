<?php

namespace App\Http\Controllers;

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
        return view('privilege.create',[
            'info'      =>  [],
            'modes'     =>  [['id'=>1,'name'=>'无限制']],
        ]);
    }
}
