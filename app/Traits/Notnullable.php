<?php
namespace App\Traits;

trait Notnullable
{
    public function ArrayValueNotNull( Array $data )
    {
        return array_map( function($v) {
            return is_null($v) ? '' : $v;
        }, $data );
    }
}