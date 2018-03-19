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
        'relation'  =>  ['uuid'],

    ];

    public function index( Request $request )
    {
        return [ 'code'=>0, 'data'=>Model::get() ];
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
}