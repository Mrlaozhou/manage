<?php

namespace App\Api\Auth;


use Illuminate\Cache\RateLimiter;

trait Throttles
{

    protected function limiter()
    {
        return app( RateLimiter::class );
    }
}