<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Model\Admin;
use App\Support\Unique;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    //
    public function index (Request $request)
    {
        return view('admin.index');
    }

    public function create (Request $request)
    {
        // TODO 取出角色信息
        $roles      =   DB::table('role')->select(...['uuid','name'])->where('status','<>','-7')->get()->toArray();
        // 取出当前数据
        return view('admin.create',[
            'handle'        =>  'create',
            'roles'         =>  $roles,
        ]);
    }

    public function delete (Request $request,$id)
    {

    }

    public function update (Request $request,$uuid)
    {
        // TODO 获取当前管理员信息、获取角色列表、获取当前管理员-角色信息
        // 管理员信息
        if( !$info = DB::table('admin')->where('uuid',$uuid)->first() ) throw new NotFoundHttpException('数据无效');
        // 角色信息
        $roles      =   DB::table('role')->select(...['uuid','name'])->where('status','<>','-7')->get()->toArray();
        // 当前管理员下角色信息
        $existsInfos  =   DB::table('relation1')->where('auuid',$uuid)->get()->toArray();
        $existsIds  =   array_column( $existsInfos, 'ruuid' );
        return view('admin.create',[
            'handle'    =>  'update',
            'info'      =>  $info,
            'roles'     =>  $roles,
            'existsIds' =>  $existsIds,
        ]);
    }
}
