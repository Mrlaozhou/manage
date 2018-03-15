<?php
namespace App\Api;
use App\Traits\ValidateScene;
use App\Traits\ValidPrivilege;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class Base extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ValidateScene, ValidPrivilege;

    protected static $Harmonious = [
        1   =>  "I know it's just a little joke.",
        2   =>  "Are you trying to move me ?",
    ];
}