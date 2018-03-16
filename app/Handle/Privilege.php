<?php

namespace App\Handle;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Privilege
{
    public static $store;

    public static $allowFields = ['uuid','name','route','alias','module','controller','action','mode','pid','type','style'];

    /**
     * @ 所有
     * @param array $fields
     * @return mixed
     */
    public static function all ()
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

    public static function own ($uuid='')
    {
        $fields = ['p.name','p.alias','p.route','p.mode','p.type','p.pid'];
        return static::drive($fields)
            ->leftjoin('relation2 as rp','rp.puuid','=','p.uuid')
            ->leftjoin('role as r','r.uuid','=','rp.ruuid')
            ->leftjoin('relation1 as ar','ar.ruuid','=','r.uuid')
            ->leftjoin('admin as a','a.uuid','=','ar.auuid')
            ->where([['p.status','1'],['r.status','1'],['a.status','1'],['a.uuid',$uuid]])
            ->get();

    }

    public static function drive ($fields=[])
    {
        return static::RedisDrive() ?: static::DBdrive($fields);
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

//        Redis::set('manage:privileges',static::$store);

        return static::$store;
    }

    public static function RedisDrive()
    {
        return Redis::get('manage:privileges');
    }
}