<?php

namespace App\Traits;

trait ArrayObject
{
    public function groups($array,$key)
    {
        $result = [];
        foreach ($array as $item){
            if ( is_object($item) ){
                $result[$item->{$key}][] = $item;
            }else{
                $result["{$key}"][] = $item;
            }
        }
        return $result;
    }

    public function onlyKey($array,$key)
    {
        $result = [];
        foreach( $array as $item ){
            if( is_object($item) ){
                $result[] = $item->{$key};
            }else{
                $result[] = $item["{$key}"];
            }
        }
        return $result;
    }
}