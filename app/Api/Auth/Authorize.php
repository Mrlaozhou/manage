<?php
namespace App\Api\Auth;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Support\Hint;

trait Authorize
{
    use Throttles;

    protected static $rules = [
        'username'      =>  'required|between:8,20',
        'password'      =>  'required|between:8,20',
    ];

    /**
     * @ 登陆
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function login (Request $request)
    {
        // TODO 用户是否已经登陆、数据初次验证、尝试登陆
        // -- 用户是否已经登陆
        if( $request->user() )  throw new ApiException( ' Login Yet.' );

        // 数据初次验证
        if( Validator::make( $certificate=$this->Certificate($request), self::$rules )->fails() )
            throw new ApiException( Hint::tactful(1) );

        // -- 尝试登陆
        if( $this->attemptLogin( $certificate ) )
            return [ 'code'=>2900, 'status'=>true, 'message'=>'', 'data'=>'' ];

        return [ 'code'=>2901, 'status'=>'', 'message'=>Hint::tactful(2), 'data'=>'' ];
    }

    /**
     * @ 登出
     * @param Request $request
     * @return array
     */
    public function logout( Request $request )
    {
        if( !$request->user() || $this->guard()->logout() )
            return ['code'=>4901, 'status'=>false, 'message'=>Hint::tactful(4), 'data'=>'' ];

        return ['code'=>2900, 'status'=>true, 'message'=>Hint::tactful(3), 'data'=>'' ];
    }

    /**
     * @ 尝试执行登陆
     * @param $certificate
     * @return mixed
     */
    protected function attemptLogin( $certificate )
    {
        return $this->guard()->attempt( $certificate );
    }

    /**
     * @ 获取登录证书
     * @param $request
     * @return mixed
     */
    protected function Certificate( $request )
    {
        return $request->only( 'username', 'password' );
    }

    /**
     * @ 获取守护进程
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard();
    }
}