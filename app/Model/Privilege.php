<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    //
    protected $table = 'privilege';

    public function createPrivilege($data)
    {
        return static::create($data);
    }
}
