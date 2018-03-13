<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RoleController extends Controller
{
    //
    public function index (Request $request)
    {
        return view('role.index');
    }

    public function create (Request $request)
    {
        // TODO 取出权限信息、
        $privileges = $this->privileges();
        $privileges = Trees($privileges);
//        dump($privileges);
        return view('role.create',[
            'handle'        =>  'create',
            'privileges'    =>  $privileges,
        ]);
    }

}
