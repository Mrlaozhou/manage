<?php

namespace App\Http\Middleware;

use App\Exceptions\AccessControlException;
use App\Exceptions\ApiException;
use App\Handle\Privilege;
use Closure;
use App\Support\Hint;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Arr;
use App\Support\ArrayObject;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 是否开启访问控制
        if( env('ACCESS_CONTROL') === false ) return $next($request);
        // TODO isRoot、权限信息分组、按照请求类型分发
        // -- 是否是root
        if( $this->isRoot($request) ) return $next($request);
        // -- 权限分组
        $groups     =   ArrayObject::groups( Privilege::valid(), 'type' );
        // -- 按照请求类型分发
        $request->isXmlHttpRequest()
            ?   $this->api( $request, ArrayObject::subItemToKey( ArrayObject::ObjectToArray( $groups['9'] ), 'route' ) )
            :   $this->web( $request, ArrayObject::subItemToKey( ArrayObject::ObjectToArray( $groups['1'] ), 'route' ) );

        return $next($request);
    }

    protected function web( $request, $routesMap )
    {
        // -- 当前路由
        $route      =   ( $path = $request->path() ) == '/' ? '/' : str_replace('/','^',$path);
        $this->verifyRouting( $routesMap, $route );
    }

    protected function api( $request, $routesMap  )
    {
        // TODO 路由获取拼接、路由map转换、
        // -- 当前路由
        $path       =   explode( '/',$request->path() );
        // -- 路由拼接
        $route      =   count($path) > 2 ? $path[1].'^'.$path[2] : $path[1];
        $this->verifyRouting( $routesMap, $route );
    }

    protected function verifyRouting( $routesMap, $route )
    {
        // 路由是否合法
        if( !$current = $routesMap[$route] ?? false )
            throw new AccessControlException( Hint::tactful(5) );
        // 验证类型
        $modeSign       =   config('auth.mode')[$current['mode']];
        switch ($modeSign){
            case 'LOGIN':
                if( Auth::user() ) return ;
                throw new AccessControlException( Hint::tactful(7) );
                break;
            case 'NONE':
                return ;
                break;
            case 'ROOT':
                if( Auth::user() && $this->isRoot() )  return ;
                throw new AccessControlException( Hint::tactful(999) );
            case 'AUTH':
                // 获取当前用户权限列表
                if( ($uuid=Auth::id()) && ($owner = Privilege::own($uuid)) ){
                    // 取当前模式下组
                    $ownMap  =      ArrayObject::subItemToKey( ArrayObject::groups($owner,'type')[$current['type']] ?? [], 'route' ) ;
                    // 已授权
                    if( $ownMap[$route] ?? false )  return ;
                }

                throw new AccessControlException( Hint::tactful(4) );
                break;
        }

        return ;
    }

    protected function isRoot ($request)
    {
        return ( Auth::id() == env('ROOT') );
    }
}
