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

    /**
     * @var string
     */
    protected $rememberTokenName = '';

    public $timestamps      =   false;


    public function validateCredentials($user, $credentials)
    {
        // TODO 证书验证、登陆记录
        $certificate = ( $user->attributes['issalt'] == '1' )
            ?   Unique::checkSaltedPassword( $credentials['password'], $user->attributes['salt'], $user->attributes['password'] )
            :   Unique::checkPassword( $credentials['password'], $user->attributes['password'] );

        return $certificate && $this->_loginrecordupdate( $user );
    }

    private function _loginrecordupdate($user)
    {
        $user->lastlogintime    =   time();
        return $user->save();
    }
}