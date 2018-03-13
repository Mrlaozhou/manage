<?php

namespace App\Http\Controllers;

use App\Traits\ValidateScene;
use App\Traits\ValidPrivilege;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ValidateScene, ValidPrivilege;
}
