<?php

namespace App\Http\Controllers;

use App\Handle\Privilege;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function index (Request $request)
    {

        // TODO 获取当前用户的权限列表
//        $pris = $this->showSlider();
        $pris = Privilege::slide();
        $pris = Trees($pris);

        return view('index',[
            'pris'          =>      $pris,
        ]);
    }

}
