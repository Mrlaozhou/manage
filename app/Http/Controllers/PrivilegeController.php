<?php

namespace App\Http\Controllers;

use App\Model\Mode;
use Illuminate\Http\Request;
use DB;

class PrivilegeController extends Controller
{
    public static $allowFields = ['uuid','name','route','status','alias','createdby',
        'createdtime','updatedby','updatedtime','module','controller','action','mode','pid','type','style'];
    //
    public function index (Request $request)
    {
        return view('privilege.index');
    }

    public function create (Request $request)
    {
        // TODO 获取有效 mode数据、视图渲染
        // 模式数据
        $modes          =   DB::table('mode')->select('uuid','name')->where('status','1')
            ->orderBy('createdtime')
            ->get()->toArray();
        // 权限列表
        $privileges     =   Sorts( $this->privilegeList()->toArray(),true);

        // 显示列表
        $styles         =   self::$_octal;

        return view('privilege.create',[
            'handle'        =>      'create',
            'modes'         =>      $modes,
            'privileges'    =>      $privileges,
            '_style'        =>      $styles,
        ]);
    }

    public function update (Request$request, $uuid)
    {
        // TODO 获取当前权限数据、模式数据、权限列表、当前权限的下级权限,显示类型
        // 当前数据
        $info           =   DB::table('privilege')->where('uuid',$uuid)->first();
        $info->styles   =   self::_octalMap($info->style);
        // 模式数据
        $modes          =   DB::table('mode')->select('uuid','name')->where('status','1')
            ->orderBy('createdtime')
            ->get()->toArray();
        // 权限列表
        $privileges     =   Sorts( $this->privilegeList()->toArray(),true);
        $subItems       =   Sorts($privileges,true,$uuid);
        $subIds         =   array_map(function($v){
            return $v->uuid;
        },$subItems);
        $subIds[]       =   $uuid;
        // 显示列表
        $styles         =   self::$_octal;

        return view('privilege.create',[
            'handle'        =>      'update',
            'info'          =>      $info,
            'modes'         =>      $modes,
            'privileges'    =>      $privileges,
            'subIds'        =>      $subIds,
            '_style'        =>      $styles,
        ]);
    }

    protected function privilegeList()
    {
        return DB::table('privilege')->select(...['uuid','name','pid'])
            ->where('status','1')->get();
    }
}
