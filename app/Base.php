<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    //
    protected $primaryKey   =   'uuid';
    protected $keyType      =   'string';
    public $incrementing    =   false;
    public $timestamps      =   false;
}
