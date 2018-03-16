<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\Unique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiter;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {
        dump( $request->path() );
    }
}
