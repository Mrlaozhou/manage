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
        'update'        =>  [ 'uuid', 'password', 'password_confirmation', 'issalt', 'status', 'intro', 'avatar', 'phone', 'email' ],
        'update_without_pass' =>  [ 'uuid', 'status', 'intro', 'avatar', 'phone', 'email' ],
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
        // ---- 验证关联字段
        foreach ( $ruuids as $ruuid ):
            $ruuidValidator     =   Validator::make( ['ruuid'=>$ruuid], $this->scene('relation')  );
            if( $ruuidValidator->fails() )  throw new ApiException( $ruuidValidator->errors() );
        endforeach;
        // -- 数据填充
        $create['uuid']           =   Unique::UUID();
        $create['createdby']      =   '4203A4F8837C1B66C201F9C230F8E3D1';
        $create['createdtime']    =   time();
        // 加密
        $crypt                  =   $create['issalt']
            ?   Unique::generatePasswordWithSalt( $create['password'] )
            :   Unique::generatePassword( $create['password'] );
        $create['password']       =   $crypt['password'] ?? $crypt;
        $create['salt']           =   $crypt['salt'] ?? '';
        // 去除验证密码
        unset($create['password_confirmation']);
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

    public function update (Request $request)
    {
        // TODO 数据接收、验证(有无密码两种情况)、数据填充、数据处理
        // -- 数据接收
        $update = $request->get('update');
        $ruuids = $request->get('ruuids') ?: [];
        // -- 数据验证
        // ---- 是否密码重置验证
        $isResetPassword = ( $update['password'] != '' );
        $adminValidator = ( $isResetPassword == false )
            ?   Validator::make( $update, $this->scene( 'update_without_pass' ) )
            :   Validator::make( $update, $this->scene( 'update' ) );
        // ---- 异常处理
        if( $adminValidator->fails() )  throw new ApiException( $adminValidator->errors() );
        // ---- 验证关联表
        foreach ( $ruuids as $ruuid ):
            $ruuidValidator     =   Validator::make( ['ruuid'=>$ruuid], $this->scene('relation')  );
            if( $ruuidValidator->fails() )  throw new ApiException( $ruuidValidator->errors() );
        endforeach;
        // -- 数据填充
        $update['updatedby']        =   '4203A4F8837C1B66C201F9C230F8E3D1';
        $update['updatedtime']      =   time();
        if ( $isResetPassword )
        {
            // ------ 加密
            $crypt                  =   $update['issalt']
                ?   Unique::generatePasswordWithSalt( $update['password'] )
                :   Unique::generatePassword( $update['password'] );
            $update['password']       =   $crypt['password'] ?? $crypt;
            $update['salt']           =   $crypt['salt'] ?? '';
        }
        else
        {
            unset($update['password']);
            unset($update['issalt']);
        }
        // -- 数据处理 去除 null、用户名禁止改动
        unset($update['username']);unset($update['password_confirmation']);
        $update     =   array_map( function($v){ return is_null($v) ? '' : $v; },$update );
        // -- 写库
        DB::transaction( function() use($update,$ruuids){
            $uuid = $update['uuid'];
            // ---- 更新主表
            DB::table('admin')->where( 'uuid',$uuid )->update( $update );
            // ---- 删除关联表原有关联
            DB::table('relation1')->where( 'auuid',$uuid )->delete();
            // ---- 插入新关联
            $relations = array_map(function($v) use($uuid){ return ['auuid'=>$uuid,'ruuid'=>$v]; },$ruuids);
            DB::table('relation1')->insert($relations);
        } );
        return [ 'code'=>2900, 'status'=>'', 'message'=>$ruuids, 'data'=>$update ];
    }
}