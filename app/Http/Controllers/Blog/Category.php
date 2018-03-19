<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Model\Blog\Category as Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait Category
{
    //
    public function category_index (Request $request)
    {
        return view('blog.category-index');
    }

    public function category_create (Request $request)
    {
        // TODO 取出父级元素
        $parents        =   Model::where('status',1)->select(...['uuid','name','pid'])->get();
        $parents        =   Sorts( $parents, true );
        return view('blog.category-create',[
            'handle'        =>  'create',
            'parents'       =>  $parents,
        ]);
    }

    public function category_update (Request $request, $uuid)
    {
        // TODO 获取当前分类信息、所有分类信息, 当前元素子元素集
        // -- 当前数据
        if( !$info = Model::find($uuid) )   throw new NotFoundHttpException( '数据无效' );
        // -- 所有分类
        $parents        =   Sorts( Model::where( 'status', 1 )->get(), true ) ;
        // -- 当前子元素id集
        $subIds         =   array_merge( [$uuid], array_column( Sorts( $parents, true, $uuid ) , 'uuid' ) );

        return view( 'blog.category-create', [
            'handle'        =>  'update',
            'parents'       =>  $parents,
            'info'          =>  $info,
            'subIds'        =>  $subIds,
        ] );
    }

}
