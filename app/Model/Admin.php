<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Base;
class Admin extends Base
{
    //
    protected $table = 'admin';
//    protected $guarded = ['uuid','password','salt','createdby','updatedby'];
    protected $guarded = [];
    public function createdAdmin($data)
    {
        return static::create($data);
    }

    public function searchAdmin( $conditions=[],$limit=[],$order=[] )
    {
        return $this->_adminQueryBuilder($conditions)
            ->select('*')
            ->limit('0')
            ->orderBy('createdtime');
    }
    protected function _adminQueryBuilder( $conditions )
    {
        $builder = $this->newBaseQueryBuilder()
            ->where('username = :username');
        return $builder;
    }
}
