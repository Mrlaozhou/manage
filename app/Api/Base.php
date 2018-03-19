<?php
namespace App\Api;
use App\Exceptions\ApiException;
use App\Traits\Notnullable;
use App\Traits\ValidateScene;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Base extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ValidateScene, Notnullable;

    public static function operatorUUID()
    {
        return Auth::id();
    }

}