<?php
namespace App\Api;
use Illuminate\Http\Request;
use App\Api\Base;
use App\Support\Unique;
use App\Model\Admin as AdminModel;
class Admin extends Base
{
    public function index( Request $request )
    {
        //
        $adminModel = new AdminModel();
        $data = $adminModel::where('status','=','1')->get();

        return ['code'=>0,'msg'=>'','data'=>$data,'count'=>1];
    }

    public function create (Request $request)
    {
        // 数据验证
        $data =$request->validate([
            'username'      =>  'required|min:8|max:20',
            'password'      =>  'required|min:8|max:20|confirmed',
            'password_confirmation' =>  'required|min:8|max:20',
            'issalt'        =>  'required|in:0,1',
            'status'        =>  'required|in:0,1',
            'intro'         =>  'nullable|max:300',
            'avatar'        =>  'nullable|max:120',
            'phone'         =>  'nullable|phone',
            'email'         =>  'nullable|email',
        ]);
        // 实例化模型
        $adminModel             =   new AdminModel();
        // 主键
        $data['uuid']           =   Unique::UUID();
        // 操作者
        $data['createdby']      =   '1.';
        // 加密
        $crypt                  =   $data['issalt']
            ?   Unique::generatePasswordWithSalt( $data['password'] )
            :   Unique::generatePassword( $data['password'] );
        $data['password']       =   $crypt['password'] ?? $crypt;
        $data['salt']           =   $crypt['salt'] ?? '';
        // 去除验证密码
        unset($data['password_confirmation']);
        // 数据填充
        $data['createdtime']    =   time();
        // 去除 null
        $data                   =   array_map(function($v){ return is_null($v) ? '' : $v; },$data);
        $result                 =   $adminModel->createdAdmin($data);

        return ['code'=>200, 'status'=>$result, 'message'=>'', 'data'=>$data];
    }
}