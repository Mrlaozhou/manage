<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use TheSeer\Tokenizer\TokenCollectionException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // 访问控制异常
        if( $exception instanceof AccessControlException){
            if( $request->isXmlHttpRequest() )
                return response()->json([ 'code'=>4903, 'status'=>false, 'message'=>$exception->getMessage(), 'data'=>'' ]);

            return redirect( $request->user() ? '/default' : '/login' );
        }
        // 接口异常
        if( $exception instanceof ApiException)
            return response()->json([ 'code'=>4901, 'error'=>$exception->getMessage(), 'data'=>'']);

        // token 验证异常
        if( $exception instanceof TokenMismatchException && $request->isXmlHttpRequest() )
            return response()->json(['code'=>4919, 'error'=>'Illegal.','data'=>'']);

        // 验证异常
        if( $exception instanceof ValidationException && $request->isXmlHttpRequest()) {
            $errors = array_values( $exception->errors() );
            $error = $errors[0][0];
            return response()->json(['code'=>4902, 'message' =>'', 'error'=>$error, 'data'=>  '',]);
        }

        return parent::render($request, $exception);
    }
}
