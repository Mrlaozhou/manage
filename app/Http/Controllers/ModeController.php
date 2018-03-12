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
    public function index (Request $request)
    {
        return view('mode.index');
    }

    public function create (Request $request)
    {
        return view('mode.create',[
            'handle'    =>  'create',
        ]);
    }

    public function update (Request $request,$uuid)
    {
        $modeModel = new Mode();
        $info = $modeModel::find($uuid)->toArray();
        return view('mode.create',[
            'handle'        =>      'update',
            'info'          =>      $info,
        ]);
    }

    public function delete (Request $request){}
}
