<?php
namespace App\Api\Blog;
use App\Exceptions\ApiException;
use App\Support\Unique;
use Illuminate\Http\Request;
use App\Model\Blog\Category as Model;
use Illuminate\Support\Facades\Validator;

trait Category
{
    protected static $categoryrules = [
        'uuid'      =>  'required|uuid',
        'name'      =>  'required|alpha_dash|max:60',
        'sign'      =>  'nullable|alpha|max:60',
        'status'    =>  'in:0,1',
        'pid'       =>  'nullable|uuid',
    ];

    protected static $categoryscene = [
        'insert'        =>  ['name','alias','status','pid'],
        'update'        =>  ['uuid','name','alias','status','pid'],
    ];

    public function category_index (Request $request)
    {
        $data = Model::get();
        $data = Sorts($data,true);
        return ['code'=>0,'data'=>$data];
    }

    public function category_create (Request $request)
    {
        // TODO 数据接收、验证、数据填充、处理、写库
        // -- 数据接收、验证
        $create         =   $request->get( 'create' );
        $validator      =   Validator::make( $create, $this->scene('insert','categoryscene','categoryrules')  );
        // ---- 异常抛出
        if( $validator->fails() )   throw new ApiException( $validator->errors() );

        // -- 数据填充
        $create['uuid']             =   Unique::UUID();
        $create['createdby']        =   self::operatorUUID();
        $create['createdtime']      =   time();
        // -- 数据处理
        $create             =   $this->ArrayValueNotNull($create);
        $create['status']   =   (int)$create['status'];
        // -- 写库
        Model::insert($create);

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>$create ];
    }

    public function category_update (Request $request)
    {
        // TODO 数据接收、验证、数据填充、数据处理、写库
        // -- 数据接收
        $update         =   $request->get( 'update' );
        // -- 数据验证
        $validator      =   Validator::make( $update, $this->scene( 'update', 'categoryscene', 'categoryrules' ) );
        // -- 异常抛出
        if( $validator->fails() )   throw new ApiException( $validator->errors() );
        // -- 数据填充
        $update['updatedby']        =   self::operatorUUID();
        $update['updatedtime']      =   time();
        // -- 数据处理
        $update             =   $this->ArrayValueNotNull( $update );
        // -- 写库

        Model::where('uuid',$update['uuid'])->update($update);

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>$update ];
    }

    public function category_delete (Request $request)
    {
        // 删除
        $uuid       =   $request->get('uuid');

        dump($uuid);
    }
}