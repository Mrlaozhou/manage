<?php

namespace App\Support;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Traits\Macroable;
class Unique
{
    use Macroable;

    public static function basis()
    {
        return uniqid(mt_rand(),true);
    }

    public static function UUID($upper=true)
    {
        return $upper ? strtoupper( md5( static::basis() ) ) : md5( static::basis() );
    }

    public static function UUIDWidthPrefix($prefix)
    {
        return $prefix.static::UUID();
    }

    public static function generatePassword($password)
    {
        return Hash::make($password);
    }

    public static function generatePasswordWithSalt($password,$salt=null)
    {
        $salted = $salt ?? self::UUID();
        return  [
            'password'  =>      Hash::make( self::addSalt($password,$salted) ),
            'salt'      =>      $salted,
        ];
    }
    public static function checkPassword($current,$crypted)
    {
        return Hash::check($current,$crypted);
    }

    public static function checkSaltedPassword($current,$salted,$crypted)
    {
        return Hash::check(self::addSalt($current,$salted),$crypted);
    }

    private static function addSalt($password,$salted)
    {
        return $password.'{'.$salted.'}';
    }
}