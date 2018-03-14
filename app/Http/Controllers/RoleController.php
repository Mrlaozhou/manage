<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
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
        $privileges = $this->showAuth();
        $privileges = Trees($privileges);
//        dump($privileges);
        return view('role.create',[
            'handle'        =>  'create',
            'privileges'    =>  $privileges,
        ]);
    }

    public function update (Request $request, $uuid)
    {
        // TODO 获取权限列表、获取当前角色信息、获取当前角色-权限信息、写库
        // -- 获取权限列表
        $privileges     =   Trees( $this->showAuth()->toArray() );
        // -- 获取当前角色信息
        if( !$info = DB::table('role')->where('uuid',$uuid)->first() ) throw new ApiException('数据无效');
        // -- 获取当前角色-权限信息
        $existsPrivileges   =   DB::table('relation2')->where('ruuid',$uuid)->get()->toArray();
        $existsPuuids       =   array_column( $existsPrivileges,'puuid' );
        return view('role.create',[
            'handle'        =>      'update',
            'info'          =>      $info,
            'privileges'    =>      $privileges,
            'existsPuuids'  =>      $existsPuuids,
        ]);
    }

}
