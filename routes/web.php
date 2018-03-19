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

Route::get('/', 'IndexController@index');

Route::get('login',function() {
   return view('login');
});
Route::get('default',function (){
    return view('default');
});
// 验证模式
Route::get('mode/index','ModeController@index');
Route::get('mode/create','ModeController@create');
Route::get('mode/update/{uuid}','ModeController@update');

// 权限
Route::get('privilege/index','PrivilegeController@index');
Route::get('privilege/create','PrivilegeController@create');
Route::get('privilege/update/{uuid}','PrivilegeController@update');

// 角色
Route::get('role/index','RoleController@index');
Route::get('role/create','RoleController@create');
Route::get('role/update/{uuid}','RoleController@update');

// 用户
Route::get('admin/index','AdminController@index');
Route::get('admin/create','AdminController@create');
Route::get('admin/update/{uuid}','AdminController@update');

Route::get('test','TestController@index');

// 博客
include_once __DIR__.'/web/blog.php';