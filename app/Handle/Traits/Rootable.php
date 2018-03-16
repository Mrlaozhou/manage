<?php
namespace App\Handle\Traits;

use Illuminate\Support\Facades\Auth;

trait Rootable
{
    public function isRoot()
    {
        return Auth::user()->isRoot();
    }
}