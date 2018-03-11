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
// mode
Route::post('/mode/create', 'Mode@create')->name('api.mode.create');
Route::get('/mode/delete', 'Mode@delete')->name('api.mode.delete');
Route::get('/mode/update', 'Mode@update')->name('api.mode.update');
Route::get('/mode/search', 'Mode@search')->name('api.mode.search');

// admin
Route::post('/admin/create', 'Admin@create')->name('api.admin.create');
Route::post('/admin/index', 'Admin@index')->name('api.admin.index');

// role
Route::post('/role/create', 'Role@create')->name('api.role.create');

// privilege
Route::post('/privilege/create', 'Privilege@create')->name('api.privilege.create');
