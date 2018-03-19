<?php

// 博客
Route::get('blog/index','BlogController@index');
Route::get('blog/create','BlogController@create');
Route::get('blog/update/{uuid}','BlogController@update');
// -- 博客分类
Route::get('blog-category/index','BlogController@category_index');
Route::get('blog-category/create','BlogController@category_create');
Route::get('blog-category/update/{uuid}','BlogController@category_update');