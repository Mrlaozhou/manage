<?php

namespace App\Handle;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Privilege
{
    public static $store;

    public static $allowFields = ['p.uuid','p.name','p.route','p.alias','p.module','p.controller','p.action','p.mode','p.pid','p.type','p.style'];

    /**
     * @ 所有
     * @param array $fields
     * @return mixed
     */
    public static function all ($fields=[])
    {
        return static::drive($fields)->get();
    }

    /**
     * @ 有效的
     * @param array $fields
     */
    public static function valid ()
    {
        return static::drive()->where('status','1')->get();
    }

    /**
     * @ 用户所拥有的权限
     * @param string $uuid
     * @return mixed
     */
    public static function own ($uuid='')
    {
        $where = [['p.status','1'],['r.status','1'],['a.status','1'],['a.uuid',$uuid]];
        $fields = ['p.name','p.alias','p.route','p.mode','p.type','p.pid'];
        return static::drive($fields)
            ->leftjoin('relation2 as rp','rp.puuid','=','p.uuid')
            ->leftjoin('role as r','r.uuid','=','rp.ruuid')
            ->leftjoin('relation1 as ar','ar.ruuid','=','r.uuid')
            ->leftjoin('admin as a','a.uuid','=','ar.auuid')
            ->where($where)
            ->get();

    }

    public static function drive ($fields=[])
    {
        return static::DBdrive($fields);
    }

    /**
     * @ 数据库驱动
     * @param array $fields
     * @return mixed
     */
    public static function DBdrive ($fields=[])
    {
        $fields = $fields ?: static::$allowFields;
        static::$store = DB::table('privilege as p')->select( ...$fields );

        return static::$store;
    }
}