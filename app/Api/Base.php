<?php
namespace App\Api;
use App\Exceptions\ApiException;
use App\Traits\ValidateScene;
use App\Traits\ValidPrivilege;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Base extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ValidateScene, ValidPrivilege;

    protected static $Harmonious = [

    ];

    public static function operatorUUID()
    {
        return Auth::id();
    }
}