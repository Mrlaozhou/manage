<?php

namespace App\Model;

use App\Support\Unique;
use Illuminate\Database\Eloquent\Model;
use App\Base;
class Mode extends Base
{
    //
    protected $table = 'mode';

    protected $guarded = [

    ];

    public function createMode($data)
    {
        return static::create($data);
    }
}
