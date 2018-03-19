<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    //
    protected $connection       =   'main';

    protected $primaryKey       =   'uuid';

    protected $keyType          =   'string';

    public $timestamps          =   false;
}
