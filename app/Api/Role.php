<?php
namespace App\Api;
use App\Exceptions\ApiException;
use App\Support\Unique;
use Illuminate\Http\Request;
use App\Api\Base;
use DB;
use Illuminate\Support\Facades\Validator;
class Role extends Base
{
    protected static $rules = [
        'uuid'          =>      'required|uuid',
        'name'          =>      'required|alpha_dash|max:10',
        'sign'          =>      'nullable|required|alpha|max:60',
        'status'        =>      'required|in:0,1',
        'desc'          =>      'nullable|max:300',
        'puuids'        =>      'array',
        'puuid'         =>      'uuid',
    ];
    protected static $scene = [
        'insert'        =>      ['name','sign','status','desc'],
        'update'        =>      ['uuid','name','sign','status','desc'],
        'delete'        =>      ['uuid'],
        'relation'      =>      ['puuid'],
    ];

    public function index ( Request $request )
    {
        //
        $data = DB::table('role')->where('status','<>','-7')->get()->toArray();
        return ['code'=>0, 'status'=>'', 'message'=>'', 'data'=>$data];
    }

    public function create (Request $request)
    {
        // TODO 数据接收、验证、数据填充、数据处理、写库
        // -- 数据接收
        $create = $request->get('create');
        $puuids = $request->get('puuids') ?: [];
        // -- 数据验证
        // ---- 主表数据验证
        $createValidator = Validator::make( $create, $this->scene('insert') );
        if ( $createValidator->fails() )    throw new ApiException( $createValidator->errors() );
        // ---- 关联数据验证
        foreach( $puuids ?? [] as $uuid ):
            $puuidValidator = Validator::make( ['puuid'=>$uuid], $this->scene('relation')  );
            if( $puuidValidator->fails() )  throw new ApiException( '权限uuid出错：'.$uuid );
        endforeach;
        // -- 数据填充
        $create['uuid']             =   Unique::UUID();
        $create['createdby']        =   self::operatorUUID();
        $create['createdtime']      =   time();
        // -- 数据处理 去除null
        $create                     =   array_map( function($v){ return is_null($v) ? '' : $v; }, $create );
        // -- 写库
        DB::transaction(function() use($create,$puuids){
            // 写role表
            DB::table('role')->insert($create);
            // 写关联表
            $ruuid = $create['uuid'];
            $relations = array_map(function($v) use($ruuid){ return ['ruuid'=>$ruuid,'puuid'=>$v]; },$puuids);
            DB::table('relation2')->insert($relations);
        });
        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>'' ];
    }

    public function update (Request $request)
    {
        // TODO 数据接收、验证、数据填充、数据处理、写库
        // -- 数据接收、验证
        $update             =   $request->get('update');
        $puuids             =   $request->get('puuids') ?: [];

        // -- 数据验证
        // ---- 主表验证
        $updateValidator    =   Validator::make( $update, $this->scene('update') );
        if( $updateValidator->fails() ) throw new ApiException( $updateValidator->errors() );
        // ----关联验证
        foreach( $puuids ?? [] as $uuid ):
            $puuidValidator = Validator::make( ['puuid'=>$uuid], $this->scene('relation')  );
            if( $puuidValidator->fails() )  throw new ApiException( '权限uuid出错：'.$uuid );
        endforeach;
        // -- 数据填充
        $update['updatedby']    =   self::operatorUUID();
        $update['updatedtime']  =   time();
        // -- 数据处理
        $update                 =   array_map( function($v){ return is_null($v) ? '' : $v; }, $update );
        // -- 写库
        DB::transaction(function() use($update, $puuids){
            $ruuid = $update['uuid'];
            // 更新主表信息
            DB::table('role')->where('uuid',$ruuid)->update($update);
            // 删除原有关联数据
            DB::table('relation2')->where('ruuid',$ruuid)->delete();
            // 写入新的关联
            $relations = array_map(function($v) use($ruuid){ return ['ruuid'=>$ruuid,'puuid'=>$v]; },$puuids);
            DB::table('relation2')->insert($relations);
        });

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>$puuids ];
    }

    public function delete (Request $request)
    {
        // TODO 数据接收、验证、删除主表数据、删除关联表数据（relation1、relation2）
        // -- 数据接收
        $uuid       =   $request->get('uuid');
        // -- 数据验证
        if( Validator::make( ['uuid'=>$uuid], $this->scene( 'delete' ) )->fails() )
            throw new ApiException( '数据无效' );
        // -- 写库
        DB::transaction( function() use($uuid){
            // 删除主表数据
            DB::table('role')->where( 'uuid', $uuid )->delete();
            // 删除relation2 ( r--p ) 关联信息
            DB::table('relation2')->where( 'ruuid', $uuid )->delete();
            // 删除relation1 ( a--r ) 关联信息
            DB::table('relation1')->where( 'ruuid', $uuid )->delete();
        } );

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>'' ];
    }
}