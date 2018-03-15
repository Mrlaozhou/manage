<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User;
use App\Support\Unique;
class Certificate extends User
{
    /**
     * @ 表名
     * @var string
     */
    protected $table        =   'admin';

    /**
     * @ 主键
     * @var string
     */
    protected $primaryKey   =   'uuid';

    /**
     * @ 主键数据类型
     * @var string
     */
    protected $keyType      =   'string';

    protected $hidden       =   [ 'password', 'salt', 'createdby', 'updatedby' ];


    public function validateCredentials($user, $credentials)
    {
        return ( $user->attributes['issalt'] == '1' )
            ?   Unique::checkSaltedPassword( $credentials['password'], $user->attributes['salt'], $user->attributes['password'] )
            :   Unique::checkPassword( $credentials['password'], $user->attributes['password'] );
    }
}