<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

trait Config
{
    public function returnConfig(Request $request)
    {
        return config('upload.ueditorConfig');
    }

}
