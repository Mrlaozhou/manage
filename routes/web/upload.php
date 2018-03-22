<?php


// 返回配置信息给前段
Route::get( 'upload/config', 'UploadController@returnConfig');

// 上传
Route::post( 'upload/index/{type}', 'UploadController@index' );