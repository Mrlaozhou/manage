<?php

namespace App\Http\Controllers;

use App\Handle\PrivilegeHandle;
use App\Model\Blog;
use function foo\func;
use Illuminate\Http\Request;
use App\Support\Unique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {
        $info = Blog::first();
        return view('test',[
            'info'       =>  $info
        ]);
    }
}
