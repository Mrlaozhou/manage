<?php
namespace App\Api;
use Illuminate\Http\Request;
use App\Api\Base;
use App\Api\Auth\Authorize;
class Index extends Base
{
    use Authorize;

    public function index( Request $request )
    {
        //
        
    }


}