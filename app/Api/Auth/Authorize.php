<?php
namespace App\Api\Auth;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait Authorize
{
    use Throttles;

    protected static $rules = [
        'username'      =>  'required|between:8,20',
        'password'      =>  'required|between:8,20',
    ];

    public function login (Request $request)
    {
        // TODO 用户是否已经登陆、数据初次验证、尝试登陆
        // -- 用户是否已经登陆
        if( $request->user() )  throw new ApiException( ' Login Yet.' );

        // 数据初次验证
        if( Validator::make( $certificate=$this->Certificate($request), self::$rules )->fails() )
            throw new ApiException( self::$Harmonious[1] );

        // -- 尝试登陆
        if( $this->attemptLogin( $certificate ) )
            return [ 'code'=>2900, 'status'=>true, 'message'=>'', 'data'=>'' ];

        return [ 'code'=>2901, 'status'=>'', 'message'=>self::$Harmonious[2], 'data'=>'' ];
    }

    public function attemptLogin( $certificate )
    {
        return $this->guard()->attempt( $certificate );
    }

    protected function Certificate( $request )
    {
        return $request->only( 'username', 'password' );
    }

    protected function guard()
    {
        return Auth::guard();
    }
}