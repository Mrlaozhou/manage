<?php
namespace App\Api;
use Illuminate\Http\Request;
use App\Api\Base;
use App\Model\Privilege as PrivilegeModel;
class Privilege extends Base
{
    private $_rules = [
        'name'          =>      'required|between:1,30',
        'route'         =>      'required|alpha|between:1,60|unique:route',
        'status'        =>      'required|in:0,1',
        'alias'         =>      'nullable|between:1,30',
        'module'        =>      'nullable|alpha|between:1,30',
        'controller'    =>      'same:module',
        'action'        =>      'same:module',
        'mode'          =>      'required|alpha_num|',
        'pid'           =>      'required|alpha_num|',
        'type'          =>      'required|in:1,9',
    ];
    public function index( Request $request )
    {
        //
        $privilegeModel = new PrivilegeModel();
        $data = $privilegeModel::where('status','<>','-7')
            ->get();

        return ['code'=>0,'msg'=>'','data'=>$data,'count'=>1];
    }

    public function create(Request $request)
    {

    }
}