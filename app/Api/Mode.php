<?php
namespace App\Api;
use App\Http\Requests\ModeForm;
use Illuminate\Http\Request;
use App\Api\Base;
use App\Support\Unique;
use App\Model\Mode as ModeModel;
class Mode extends Base
{
    public function index ( Request $request )
    {
        //
        $modeModel = new ModeModel();
        $data = $modeModel::where('status','<>','-7')->get();

        return ['code'=>0,'msg'=>'','data'=>$data,'count'=>1];
    }

    public function create (Request $request)
    {
        $data = $request->validate(
            [
                'name'      =>  'required|max:60|alpha',
                'status'    =>  'required|in:0,1',
                'desc'      =>  'nullable|max:300',
            ],
            []);
        // 实例化模型
        $modoModel              =   new ModeModel();
        // 生成uuid
        $data['uuid']           =   Unique::UUID();
        // 创建者、创建时间
        $data['createdby']      =   '18B24A268E64969B26CB6F0C1BC12E54';
        $data['createdtime']    =   time();
        //
        $data['desc']           =   $data['desc'] ?? '';
        $result                 =   $modoModel->createMode($data);

        return ['code'=>200, 'status'=>$result, 'message'=>'', 'data'=>$data];
    }
}