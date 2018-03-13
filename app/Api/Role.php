<?php
namespace App\Api;
use Illuminate\Http\Request;
use App\Api\Base;
use DB;
class Role extends Base
{
    protected static $rules = [
        'uuid'          =>      'required|uuid',
        'name'          =>      'required|alpha_dash|max:10',
        'sign'          =>      'required|alpha|max:60',
        'status'        =>      'required|in:0,1',
        'desc'          =>      'nullable|max:300',
        'puuids'        =>      'array',
        'puuid'         =>      'required|uuid',
    ];
    protected static $scene = [
        'insert'        =>      ['name','sign','status','desc','pids'],
        'update'        =>      ['uuid','name','sign','status','desc','pids'],
        'delete'        =>      ['uuid'],
        'relation'      =>      ['puuid'],
    ];
    public function index( Request $request )
    {
        //
        $data = DB::table('role')->where('status','<>','-7')->get()->toArray();
        return ['code'=>0, 'status'=>'', 'message'=>'', 'data'=>$data];
    }
}