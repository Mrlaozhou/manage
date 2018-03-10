<?php

namespace App\Support;

use function foo\func;
use Illuminate\Support\Traits\Macroable;
class Unique
{
    use Macroable;

    public static function basis()
    {
        return uniqid(mt_rand(),true);
    }

    public static function getUUID($upper=true)
    {
        return $upper ? strtoupper( md5( static::basis() ) ) : md5( static::basis() );
    }

    public static function getUUIDWidthPrefix($prefix)
    {
        return $prefix.static::getUUID();
    }
}