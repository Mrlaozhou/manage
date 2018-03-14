<?php
namespace App\Api;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Api\Base;
use App\Support\Unique;
use DB;
class Admin extends Base
{
    protected static $rules = [
        'uuid'          =>  'required|uuid',
        'username'      =>  'required|between:8,20',
        'password'      =>  'required|between:8,20|confirmed',
        'password_confirmation' =>  'required|min:8|max:20',
        'issalt'        =>  'required|in:0,1',
        'status'        =>  'required|in:0,1',
        'intro'         =>  'nullable|max:300',
        'avatar'        =>  'nullable|max:120',
        'phone'         =>  'nullable|phone',
        'email'         =>  'nullable|email',
        'ruuid'         =>  'required|uuid',
    ];

    protected static $scene = [
        'insert'        =>  [ 'username', 'password', 'password_confirmation', 'issalt', 'status', 'intro', 'avatar', 'phone', 'email' ],
        'update'        =>  [ 'uuid', 'username', 'password', 'password_confirmation', 'issalt', 'status', 'intro', 'avatar', 'phone', 'email' ],
        'delete'        =>  [ 'uuid' ],
        'relation'      =>  [ 'ruuid' ],
    ];

    public function index( Request $request )
    {
        $data = DB::table('admin')->where('status','<>','-7')->get()->toArray();

        return ['code'=>0,'msg'=>'','data'=>$data,'count'=>1];
    }

    public function create (Request $request)
    {
        // TODO 数据接收、验证、数据填充、数据处理、写库
        // 数据接收
        $create     =   $request->get('create');
        $ruuids     =   $request->get('ruuids') ?: [];
        // -- 数据验证
        // ---- 验证主表字段
        $adminValidator         =   Validator::make( $create, $this->scene('insert') );
        if( $adminValidator->fails() )  throw new ApiException( $adminValidator->errors() );
        // ---- 验证关联表
        foreach ( $ruuids as $ruuid ):
            $ruuidValidator     =   Validator::make( ['ruuid'=>$ruuid], $this->scene('relation')  );
            if( $ruuidValidator->fails() )  throw new ApiException( $ruuidValidator->errors() );
        endforeach;
        // -- 数据填充
        $create['uuid']           =   Unique::UUID();
        $create['createdby']      =   '4203A4F8837C1B66C201F9C230F8E3D1';
        // 加密
        $crypt                  =   $create['issalt']
            ?   Unique::generatePasswordWithSalt( $create['password'] )
            :   Unique::generatePassword( $create['password'] );
        $create['password']       =   $crypt['password'] ?? $crypt;
        $create['salt']           =   $crypt['salt'] ?? '';
        // 去除验证密码
        unset($create['password_confirmation']);
        // 数据填充
        $create['createdtime']    =   time();
        // 去除 null
        $create                   =   array_map(function($v){ return is_null($v) ? '' : $v; },$create);

        DB::transaction( function() use($create,$ruuids){
            // 主表数据插入
            DB::table('admin')->insert($create);
            // 关联数据插入
            $auuid = $create['uuid'];
            $relations = array_map(function($v) use($auuid){ return ['auuid'=>$auuid,'ruuid'=>$v]; },$ruuids);
            DB::table('relation1')->insert($relations);
        } );

        return ['code'=>2900, 'status'=>'', 'message'=>'', 'data'=>''];
    }

    public function udpate (Request $request)
    {
        // TODO
    }
}