<?php
namespace App\Support;

class ArrayObject
{
    public static function groups($array,$key)
    {
        $result = [];
        foreach ($array as $item){
            if ( is_object($item) ){
                $result[$item->{$key}][] = $item;
            }else{
                $result[$item[$key]][] = $item;
            }
        }
        return $result;
    }

    public static function onlyKey($array,$key)
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

    public static function subItemToKey($array, $sub)
    {
        $result = [];
        foreach ($array as $key => $value){
            if( is_object($value) ){
                $result[$value->{$sub}] = $value;
            }else{
                $result[$value[$sub]] = $value;
            }
        }
        return $result;
    }

    public static function ObjectToArray($object)
    {
        if(is_object($object)) {
            $object = (array)$object;
        }
        if(is_array($object)) {
            foreach($object as $key=>$value) {
                $object[$key] = self::ObjectToArray($value);
            }
        }
        return $object;
    }

}