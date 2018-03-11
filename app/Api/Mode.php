<?php
namespace App\Api;
use App\Http\Requests\ModeForm;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Api\Base;
use App\Support\Unique;
use App\Model\Mode as ModeModel;
class Mode extends Base
{
    public function index ( Request $request )
    {
        //
        
    }

    public function create (Request $request)
    {
        $validateData = $request->validate(
            [
                'name'      =>  'required|max:60|alpha',
                'status'    =>  'required|in:0,1',
            ],
            []);
        // 实例化模型
        $result = (new ModeModel())->createMode($validateData);

        return $result;
    }
}