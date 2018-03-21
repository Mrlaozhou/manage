<?php
namespace App\Api;
use App\Api\Blog\Category;
use App\Exceptions\ApiException;
use App\Support\Unique;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Api\Base;
use Illuminate\Support\Facades\DB;
use App\Model\Blog as Model;
use App\Model\Blog\Relation;
use PhpParser\Node\Expr\AssignOp\Mod;

class Blog extends Base
{
    use Category;

    protected static $rules = [
        'uuid'          =>  'required|uuid',
        'title'         =>  'required|alpha_dash|max:60',
        'short'         =>  'required|max:300',
        'cover'         =>  'nullable|alpha_dash|max:100',
        'content'       =>  'nullable',
        'publishedtype' =>  'required|in:0,1,2',
        'status'        =>  'required|in:0,1',
    ];

    protected static $scene = [
        'insert'    =>  ['title','short','cover','content','publishedtype','status'],
        'update'    =>  ['uuid','title','short','cover','content','publishedtype','status'],
        'delete'    =>  ['uuid'],
        'relation'  =>  ['uuid'],

    ];

    public $allowFields = ['uuid','title','short','cover','createdby','createdtime',
        'publishedtime','commentnum','clicks','publishedtype','agree','oppose','status'];

    public function index ( Request $request )
    {
        // 数据接收、where拼接、分页处理、数据查询
        $params     =   $request->only(['page','limit','where']);
        // where拼接
        $where      =   [];
        self::operatorUUID()==env('ROOT') ?: $where[] = ['createdby', self::operatorUUID()];
        !isset($params['where']) ?: $where[]=$params['where'];
        // 构造器
        $builder    =   Model::where( $where );
        // 数据
        $data       =   $builder->select(...$this->allowFields)
            ->forPage( (int)$params['page'],(int)$params['limit'] )->get();
        // 数量
        $count      =   $builder->count();

        return [ 'code'=>0, 'data'=>$data, 'count'=>$count ];
    }

    public function create (Request $request)
    {
        // TODO 数据接收、验证、填充、处理、写库
        // -- 数据接收、验证
        $create         =   $request->get( 'create' );
        $category       =   array_unique( $request->get( 'category' ) );
        $validator      =   Validator::make( $create, $this->scene( 'insert' ) );
        // 异常处理’
        if( $validator->fails() ) throw new ApiException( $validator->errors() );
        // 验证分类
        foreach( $category as $cuuid ):
            $cuuidValidator = Validator::make( ['uuid'=>$cuuid], $this->scene('relation')  );
            if( $cuuidValidator->fails() )  throw new ApiException( '分类信息出错：'.$cuuid );
        endforeach;
        // 填充
        $create['uuid']             =   Unique::UUID();
        $create['createdby']        =   self::operatorUUID();
        $create['createdtime']      =   time();
        $create['publishedtime']    =   $create['status'] ? time() : 0;
        $create['content']          =   $create['content'] ?? '';
        // 处理
        $create['status']           =   (int)$create['status'];
        $create['publishedtype']    =   (int)$create['publishedtype'];
        $create         =   $this->ArrayValueNotNull($create);
        // 写库
        DB::transaction( function() use($create,$category){
            // 写主库
            Model::insert( $create );
            // 关联库
            $relations = array_map( function($cuuid) use($create){ return [ 'buuid'=>$create['uuid'], 'cuuid'=>$cuuid ]; }, $category );
            Relation::insert($relations);
        } );

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>'' ];
    }

    public function update (Request $request)
    {
        // TODO 数据接收、验证、填充、处理、写库
        // -- 数据接收验证
        $update             =   $request->get('update');
        $category           =   array_unique( array_filter( $request->get('category') ?? [] ) );

        // -- 验证主表数据
        $validator          =   Validator::make( $update, $this->scene('insert') );
        // -- 异常抛出
        if( $validator->fails() )   throw new ApiException( $validator->errors() );
        // -- 验证分类数据
        foreach( $category as $cuuid ):
            $cuuidValidator = Validator::make( ['uuid'=>$cuuid], $this->scene('relation')  );
            if( $cuuidValidator->fails() )  throw new ApiException( '分类信息出错：'.$cuuid );
        endforeach;
        // -- 数据填充
        $update['publishedtime']    =   $update['status'] ? time() : 0;
        // -- 数据处理
        $update['content']          =   $update['content'] ?? '';
        $update['status']           =   (int)$update['status'];
        $update['publishedtype']    =   (int)$update['publishedtype'];
        $update         =   $this->ArrayValueNotNull($update);

        // 写库
        DB::transaction( function () use($update,$category){
            // 写主库
            Model::where('uuid',$update['uuid'])->update($update);
            // 删除原有分类信息
            Relation::where('buuid',$update['uuid'])->delete();
            // 写入新的关联
            $relations = array_map( function($cuuid) use($update){ return [ 'buuid'=>$update['uuid'], 'cuuid'=>$cuuid ]; }, $category );
            Relation::insert($relations);
        } );

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>'' ];
    }

    public function delete (Request $request)
    {
        // TODO 数据接收、验证、写库
        // -- 接收验证
        $uuid           =   $request->get( 'uuid' );
        $valdator       =   Validator::make( ['uuid'=>$uuid], $this->scene('delete') );
        // -- 异常抛出
        if( $valdator->fails() ) throw new ApiException( $valdator->errors() );
        // 写库
        DB::transaction( function () use($uuid){
            // 删除主表数据
            Model::where('uuid',$uuid)->delete();
            // 删除关联数据
            Relation::where('buuid',$uuid)->delete();
        } );

        return [ 'code'=>2900, 'status'=>'', 'message'=>'', 'data'=>'' ];
    }
}