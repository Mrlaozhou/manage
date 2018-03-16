<?php
namespace App\Api;
use App\Exceptions\ApiException;
use App\Support\Unique;
use function foo\func;
use Illuminate\Http\Request;
use App\Api\Base;
use Validator;
use DB;
class Privilege extends Base
{
    protected static $rules = [
        'uuid'          =>      'required|uuid',
        'name'          =>      'required|between:1,30',
        'route'         =>      'required|between:1,60',
        'status'        =>      'required|in:0,1',
        'alias'         =>      'nullable|between:1,30|alpha_dash',
        'module'        =>      'nullable|alpha|between:1,30',
        'controller'    =>      'same:module',
        'action'        =>      'same:module',
        'mode'          =>      'required|uuid',
        'pid'           =>      'nullable|uuid',
        'type'          =>      'required|in:1,9',
        'styles'        =>      'nullable|array',
        'style'         =>      'required|integer|in:1,2,4',
    ];

    protected static $scene = [
        'insert'        =>      ['name','route','status','alias','module','controller','action','mode','pid','type','styles'],
        'update'        =>      ['uuid','name','route','status','alias','module','controller','action','mode','pid','type','styles'],
        'delete'        =>      ['uuid'],
        'styles'        =>      ['style'],
    ];

    public static $allowFields = ['uuid','name','route','status','alias','createdby',
        'createdtime','updatedby','updatedtime','module','controller','action','mode','pid','type','style'];

    public function index ( Request $request )
    {
        $builder        =   DB::table('privilege')->select(...self::$allowFields)->where('status','<>','-7')
            ->orderBy('createdtime');
        $data           =   $builder->get();
        $data           =   Sorts($data, true);
        $count          =   $builder->count();
        return ['code'=>0,'msg'=>'','data'=>$data,'count'=>$count];
    }

    public function create (Request $request)
    {
        // TODO 数据接收、验证、字段填充、数据处理、写库
        // 数据接收、验证
        $create                 =   $request->get('create');
        $validator              =   Validator::make($create,$this->scene('insert'));
        // 异常抛出
        if ($validator->fails())    throw new ApiException($validator->errors());
        // 字段填充 uuid,createby createdtime
        $create['uuid']         =   Unique::UUID();
        $create['createdby']    =   self::operatorUUID();
        $create['createdtime']  =   time();
        // 数据处理  去除 null
        $create                 =   array_map( function($v){
            return is_null($v) ? '' : $v;
        }, $create );
        // ----处理显示方式
        $create['style'] = self::_stylesHandle( $create['styles'] ?? [] );
        unset($create['styles']);
        // 写库
        $result = DB::table('privilege')->insert($create);

        return ['code'=>2900, 'status'=>$result, 'message'=>'', 'data'=>$create];
    }

    public function update (Request $request)
    {
        // TODO 数据接收、验证、数据填充、数据处理(null,styles)、、写库
        // 数据接收验证
        $update         =   $request->get('update');
        $validator      =   Validator::make( $update, $this->scene('update') );
        // 异常抛出
        if ($validator->fails())    throw new ApiException($validator->errors());
        // 数据填充
        $update['updatedby']    =   self::operatorUUID();
        $update['updatedtime']  =   time();
        // 数据处理 去除null、
        $update                 =   array_map( function($v){
            return is_null($v) ? '' : $v;
        }, $update );
        // ----处理显示方式
        $update['style'] = self::_stylesHandle( $update['styles'] ?? [] );
        unset($update['styles']);
        // 写库
        $uuid = $update['uuid'];
        $result = DB::table('privilege')->where('uuid',$uuid)->update($update);

        return ['code'=>2900, 'status'=>$result, 'message'=>'', 'data'=>$update];
    }

    public function delete (Request $request)
    {
        // TODO 数据接收、验证、删除主表（当前及下级）信息、修改关联信息
        // -- 数据接收
        $uuid       =   $request->get('uuid');
        // -- 验证
        if( Validator::make( ['uuid'=>$uuid], $this->scene('delete') )->fails() )
            throw new ApiException( '数据无效' );
        // -- 权限列表
        $privileges =   $this->showAll()->toArray();
        // -- id集
        $ids        =   array_merge( array_column( Sorts($privileges, true, $uuid) ,'uuid' ), [$uuid]);
        DB::transaction( function () use($ids){
            // ---- 删除主表
            DB::table('privilege')->whereIn( 'uuid', $ids )->delete();
            // ---- 删除关联信息
            DB::table('relation2')->whereIn( 'puuid',$ids )->delete();
        } );

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>'' ];
    }
}