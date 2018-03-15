<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//login
Route::post('/login','Index@login')->name('api.login');
Route::post('/logout','Index@logout')->name('api.logout');


// admin
Route::post('/admin/create', 'Admin@create')->name('api.admin.create');
Route::post('/admin/index', 'Admin@index')->name('api.admin.index');
Route::post('/admin/update', 'Admin@update')->name('api.admin.update');
Route::post('/admin/delete', 'Admin@delete')->name('api.admin.delete');

// role
Route::post('/role/index', 'Role@index')->name('api.role.index');
Route::post('/role/create', 'Role@create')->name('api.role.create');
Route::post('/role/delete', 'Role@delete')->name('api.role.delete');
Route::post('/role/update', 'Role@update')->name('api.role.update');

// privilege
Route::post('/privilege/create', 'Privilege@create')->name('api.privilege.create');
Route::post('/privilege/index', 'Privilege@index')->name('api.privilege.index');
Route::post('/privilege/update', 'Privilege@update')->name('api.privilege.update');
Route::post('/privilege/delete', 'Privilege@delete')->name('api.privilege.delete');

// mode
Route::post('/mode/index','Mode@index')->name('api.mode.index');
Route::post('/mode/create','Mode@create')->name('api.mode.create');
Route::post('/mode/delete','Mode@delete')->name('api.mode.delete');
Route::post('/mode/update','Mode@update')->name('api.mode.update');
