<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class IndexController extends Controller
{
    //
    public function index (Request $request)
    {
//        $this->simulationLogin();
//        dump( $request->user() );exit;
        // TODO 获取当前用户的权限列表
        $pris = $this->showSlider();
        $pris = Trees($pris);
//        dump($pris);
        return view('index',[
            'pris'          =>      $pris,
        ]);
    }

    public function simulationLogin()
    {
        session([
                '_user'=>DB::table('admin')
                    ->select(...['uuid','username','intro','email','phone','avatar'])
                    ->where( 'uuid', env('ROOT') )->first()
            ]);
    }


}
