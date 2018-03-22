<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Upload\Config;
use App\Http\Controllers\Upload\UEditor;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    use Config,UEditor;
    //

    public function index (Request $request,$type)
    {
        // 上产处理器、上传
        return $this->{$this->getHandleByType($type)}($request);
    }

    public function getHandleByType ($type)
    {
        // 类型、方法映射
        $maps = [
            'editor_image'      =>  'editor_images_handle',
        ];

        return $maps[$type] ?? false;
    }

}
