<?php

namespace App\Http\Controllers;

use App\Support\Unique;
use Illuminate\Http\Request;
use DB;
use App\Model\Mode;
use Illuminate\Validation\Validator;

class ModeController extends Controller
{
    //
    public function index (Request $request){}

    public function create (Request $request)
    {
        return view('mode.create',[

        ]);
    }

    public function update (Request $request)
    {
        return view('mode.create');
    }

    public function delete (Request $request){}
}
