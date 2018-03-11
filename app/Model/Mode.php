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
        'username','password','salt'
    ];

    public function createMode($data)
    {
        $data['uuid'] = Unique::getUUID();
        $data['createdby'] = '';
        $data['createdtime'] = time();
        return $this->save($data);
    }
}
