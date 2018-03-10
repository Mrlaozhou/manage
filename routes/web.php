<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('login',function() {
   return view('login');
});
Route::get('default',function (){
    return view('default');
});
// 验证模式
Route::get('mode/index','ModeController@index');
Route::get('mode/create','ModeController@create');
Route::get('mode/update','ModeController@update');
Route::get('mode/delete','ModeController@delete');
// 权限
Route::get('privilege/index','PrivilegeController@index');
Route::get('privilege/create','PrivilegeController@create');
Route::get('privilege/update','PrivilegeController@update');
Route::get('privilege/delete','PrivilegeController@delete');

Route::get('test','TestController@index');