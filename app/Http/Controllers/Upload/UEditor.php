<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

trait UEditor
{
    public function editor_images_handle($request)
    {
        // 储存路径
        $dir        =   'editor/image/'.date('Y-m-d');
        // 文件信息
        $fileInfo   =   $request->file('editorImg');
        // 储存图片
        if( $url = $fileInfo->store($dir) )
            return [
                'original'=>'',
                'size'=>'',
                'state'=>'SUCCESS',
                'title'=>'http://www.52laozhou.com',
                'type'=>'',
                'url'=>'/uploads/'.$url,
            ];
    }
}
