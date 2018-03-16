<?php
namespace App\Handle\Traits;

trait WhereSupport
{
    public static $where = [
        'valid'     =>  [ ['p.status','1'], ['r.status','1'], ['a.status','1'] ],
        'valid-p'     =>  [ ['p.status','1'] ],
    ];
}