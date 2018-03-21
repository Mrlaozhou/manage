<?php
namespace App\Api\Blog;
use App\Exceptions\ApiException;
use App\Model\Blog\Relation;
use App\Support\Unique;
use Illuminate\Http\Request;
use App\Model\Blog\Category as Model;
use Illuminate\Support\Facades\Validator;
use App\Model\Blog as BlogModel;
use App\Model\Blog\Relation as RelationModel;
use Illuminate\Support\Facades\DB;

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
        'delete'        =>  ['uuid'],
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
        // TODO 数据接收、验证、判断、写库（本元素信息、且子元素、关联信息、更改有关blog分类信息）
        // -- 数据接收
        $uuid       =   $request->get('uuid');
        // -- 验证
        $validator  =   Validator::make( ['uuid'=>$uuid], $this->scene('delete','categoryscene','categoryrules')  );
        // 异常抛出
        if( $validator->fails() )   throw new ApiException( $validator->errors() );
        // 验证
        if( !Model::find($uuid) )   throw new ApiException( '数据无效' );
        // 子元素主键获取
        $subIds     =   array_column( Sorts( Model::select(...['uuid','name','pid'])->get()->toArray(),true, $uuid ) ?: [], 'uuid' );

        DB::transaction( function() use($uuid,$subIds){
            // 删除主库信息
            Model::whereIn( 'uuid',array_merge( [$uuid],$subIds ) )->delete();
            // 删除关联信息
            RelationModel::whereIn( 'cuuid',array_merge( [$uuid],$subIds ) )->delete();
        } );

        return [ 'code'=>2900, 'status'=>false, 'message'=>'', 'data'=>'' ];
    }
}