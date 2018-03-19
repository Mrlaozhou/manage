<?php
namespace App\Handle\Traits;

trait CallStaticable
{
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        $truename = substr( $name, strlen(static::$callStaticPrefix) );
        if( method_exists( static::class, $truename ) )
            return ( new static() )->{$truename}(...$arguments);
        throw new \BadMethodCallException( "{$name} is not exists in ".static::class );
    }
}