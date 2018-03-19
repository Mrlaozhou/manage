<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Blog;
use App\Http\Controllers\Blog\Category;
use App\Model\Blog\Category as CModel;
use App\Model\Blog as Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Model\Blog\Relation;

class BlogController extends Controller
{
    use Category;
    //
    public function index (Request $request)
    {
        return view('blog.index');
    }

    public function create (Request $request)
    {
        // TODO 获取分类信息
        $categories         =   CModel::where('status',1)->get();
        $categories         =   Sorts( $categories, true );
        return view( 'blog.create', [
            'categories'     =>  $categories,
            'handle'    =>  'create'
        ] );
    }

    public function update (Request $request,$uuid)
    {
        // TODO 获取分类信息、当前数据、当前分类信息
        // -- 当前信息
        if( !$info=Model::find($uuid) ) throw new NotFoundHttpException('数据无效');
        // -- 当前分类关联信息
        $relations  =   Relation::where('buuid',$uuid)->get();
        // -- 所有分类信息
        $categories         =   CModel::where('status',1)->get();
        $categories         =   Sorts( $categories, true );

        return view( 'blog.create', [
            'categories'        =>  $categories,
            'handle'            =>  'create',
            'info'              =>  $info,
            'relations'         =>  $relations,
        ] );
    }
}
