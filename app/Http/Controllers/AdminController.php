<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use App\Support\Unique;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index (Request $request)
    {
        return view('admin.index');
    }

    public function create (Request $request)
    {
        // 实例化模型
        $adminModel     =   new Admin();
        // 取出当前数据
        return view('admin.create',['handle'=>'create']);
    }

    public function delete (Request $request,$id)
    {

    }

    public function update (Request $request,$uuid)
    {
        $adminModel = new Admin();
        $info = $adminModel::find($uuid)->toArray();
        return view('admin.create',[
            'handle'    =>  'update',
            'info'      =>  $info,
        ]);
    }
}
