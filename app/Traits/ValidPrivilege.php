<?php
namespace App\Traits;
use DB;

trait ValidPrivilege
{
    protected static $_octalMap = [
        0     =>  [],
        1     =>  [1],
        2     =>  [2],
        3     =>  [1,2],
        4     =>  [4],
        5     =>  [1,4],
        6     =>  [2,4],
        7     =>  [1,2,4],
    ];

    protected static $_octal = [
        1       =>  '侧边显示',
        2       =>  '授权显示',
        4       =>  '父级显示',
    ];

    protected function showAll()
    {
        return self::_privileges()->get();
    }

    protected function showParent()
    {
        return self::_privileges()->whereIn('style',[4,5,6,7])->get();
    }

    protected function showAuth()
    {
        return self::_privileges()->whereIn('style',[2,3,6,7])->get();
    }

    protected function showSlider()
    {
        return self::_privileges()->whereIn('style',[1,3,5,7])->get();
    }

    protected static function _privileges()
    {
        return DB::table('privilege')->where('status','<>','-7');
    }

    protected static function _octalMap($oct=7)
    {
        return self::$_octalMap[$oct] ?? [];
    }

    protected static function _stylesHandle($styles=[])
    {
        if( !$styles )  return 0;
        return array_sum( array_map( function($v){ return (int)$v; }, array_values( $styles ) ) );
    }
}