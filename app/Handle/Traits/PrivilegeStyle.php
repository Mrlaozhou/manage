<?php
namespace App\Handle\Traits;

trait PrivilegeStyle
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