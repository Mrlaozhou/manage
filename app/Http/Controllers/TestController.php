<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\Unique;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {
        $ps = Unique::getUUID();
        $l = strlen(Hash::make($ps));
        dump($l);
    }
}
