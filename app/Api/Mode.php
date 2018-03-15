<?php
namespace App\Api;
use App\Exceptions\ApiException;
use App\Http\Requests\ModeForm;
use Illuminate\Http\Request;
use App\Api\Base;
use App\Support\Unique;
use App\Model\Mode as ModeModel;
use DB;
use Validator;


class Mode extends Base
{
    protected static $rules = [
        'uuid'      =>  'required|uuid',
        'name'      =>  'required|max:60|alpha',
        'status'    =>  'required|in:0,1',
        'desc'      =>  'nullable|max:300',
    ];
    protected static $scene = [
        'insert'    =>  ['name','status','desc'],
        'update'    =>  ['uuid','name','status','desc'],
        'delete'    =>  ['uuid'],
    ];

    public function index ( Request $request )
    {
        //
        $data = DB::table('mode')->where('status','<>','-7')->get();

        return ['code'=>0,'msg'=>'','data'=>$data,'count'=>1];
    }

    public function create (Request $request)
    {
        // TODO 数据接收、验证、数据填充、数据处理、写库
        // 数据接收、验证
        $create         =   $request->get('create');
        $validator      =   Validator::make( $create, $this->scene('insert') );
        // 异常处理
        if( $validator->fails() )   throw new ApiException($validator->errors());
        // 数据填充
        $create['uuid']             =   Unique::UUID();
        $create['createdby']        =   session('_user')->uuid;
        $create['createdtime']      =   time();
        // 数据处理、 去除 null
        $create     =   array_map( function($v){
            return is_null($v) ? '' : $v;
        }, $create );
        // 写库
        $result     =   DB::table('mode')->insert($create);

        return ['code'=>2900, 'status'=>$request->session()->all(), 'message'=>'', 'data'=>''];
    }

    public function update (Request $request)
    {
        // TODO 数据接收、验证、数据填充、数据处理、更新数据
        // 数据接收、验证
        $update         =   $request->get('update');
        $validator      =   Validator::make( $update, $this->scene('update') );
        // 数据填充
        $update['updatedby']    =   session('_user')->uuid;
        $update['updatedtime']  =   time();
        // 数据处理、 去除 null
        $update     =   array_map( function($v){
            return is_null($v) ? '' : $v;
        }, $update );

        // 更新
        $uuid = $uuid ?? $update['uuid'];
        unset($update['uuid']);
        $result     =   DB::table('mode')->where('uuid',$uuid)->update($update);

        return ['code'=>2900, 'status'=>$result, 'message'=>'', 'data'=>''];
    }

    public function delete (Request $request)
    {
        // TODO 数据接收、验证、删除主表数据、更新privilege数据
        // -- 数据接收
        $uuid =  $request->get('uuid');
        // -- 数据验证
        if( Validator::make( ['uuid'=>$uuid],$this->scene('delete') )->fails() )
            throw new ApiException( '数据无效' );

        DB::transaction( function () use($uuid){
            // ---- 删除主表数据
            DB::table('mode')->where( 'uuid',$uuid )->delete();
            // ---- 更新privilege表 关联数据->mode字段
            DB::table('privilege')->where( 'mode',$uuid )->update(['mode'=>'-']);
        } );

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>'' ];
    }
}