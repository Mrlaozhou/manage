<?php

// blog
Route::post('/blog/index','Blog@index')->name('api.blog.index');
Route::post('/blog/create','Blog@create')->name('api.blog.create');
Route::post('/blog/update','Blog@update')->name('api.blog.update');
Route::post('/blog/delete','Blog@delete')->name('api.blog.delete');
// -- blog-category
Route::post('/blog-category/index','Blog@category_index')->name('api.blog.category.index');
Route::post('/blog-category/create','Blog@category_create')->name('api.blog.category.create');
Route::post('/blog-category/update','Blog@category_update')->name('api.blog.category.update');
Route::post('/blog-category/delete','Blog@category_delete')->name('api.blog.category.delete');