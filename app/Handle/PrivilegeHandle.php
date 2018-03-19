<?php
namespace App\Handle;
use App\Handle\Traits\CallStaticable;
use App\Handle\Traits\PrivilegeStyle;
use App\Handle\Traits\Rootable;
use App\Handle\Traits\WhereSupport;
use App\Support\ArrayObject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Traits\Macroable;

class PrivilegeHandle extends ArrayObject
{
    use PrivilegeStyle,Rootable,WhereSupport,CallStaticable;

    public static $defaultFields = [
        'p.uuid','rp.ruuid','ar.auuid','p.name','p.route','p.alias as palias'
        ,'p.mode','p.pid','p.type','p.style as pstyle','r.name as rname'
    ];
    public static $callStaticPrefix = '_';

    /**
     * @ 所有数据
     * @return mixed
     */
    public function all()
    {
        return $this->driver()->get();
    }

    /**
     * @ 当前登录用户的权限列表
     * @return mixed
     */
    public function userOwned ()
    {
        // TODO 是否是root、获取用户uuid、数据查找
        $where = array_merge( static::$where['valid-p'], $this->isRoot() ? [] : [['a.uuid',Auth::id()]] );
        return $this->driver($where)->get();
    }

    /**
     * @ 添加权限 父级数据
     * @return mixed
     */
    public function parent ()
    {
        return $this->driver(static::$where['valid-p'])
            ->whereIn('p.style',[4,5,6,7])->get();
    }

    /**
     * @ root左侧导航全显
     * @return mixed
     */
    public function slider ()
    {
        $where = array_merge(static::$where['valid-p'], $this->isRoot() ? [] : [['a.uuid',Auth::id()]]);
        return $this->driver($where)
            ->whereIn('p.style',[1,3,5,7])->get();
    }

    /**
     * @ 角色添加时 权限显示
     * @return mixed
     */
    public function authed ()
    {
        return $this->driver(static::$where['valid-p'])
            ->whereIn('p.style',[2,3,6,7])->get();
    }

    /**
     * @ 有效数据
     * @return mixed
     */
    public function valid ()
    {
        return $this->driver( static::$where['valid-p'] )->get();
    }

    /**
     * @ 原始操作
     * @param array $where
     * @param array $fields
     * @param string $order
     * @return mixed
     */
    public function driver ($where=[],$fields=[],$order='p.createdtime')
    {
        $fields = $fields ?: static::$defaultFields;
        return DB::table('privilege as p')->select(...$fields)
            ->leftjoin( 'relation2 as rp', 'p.uuid', '=', 'rp.puuid'  )
            ->leftjoin( 'role as r', 'r.uuid', '=', 'rp.ruuid'  )
            ->leftjoin( 'relation1 as ar', 'r.uuid', '=', 'ar.ruuid'  )
            ->leftjoin( 'admin as a', 'a.uuid', '=', 'ar.auuid'  )
            ->where($where)
            ->orderBy($order,'desc');
    }

}