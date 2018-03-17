<?php

namespace App\Http\Controllers;

use App\Handle\Privilege;
use App\Handle\PrivilegeHandle;
use Illuminate\Http\Request;
use DB;
class IndexController extends Controller
{
    //
    public function index (Request $request)
    {
        // TODO 获取当前用户的权限列表
        $pris = PrivilegeHandle::_slider();
        $pris = Trees($pris);

        return view('index',[
            'pris'          =>      $pris,
        ]);
    }

}
