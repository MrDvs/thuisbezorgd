<?php

Route::get('/', 'AdminController@index')->name('admin');
Route::get('/users', 'AdminController@users')->name('users');
Route::get('/restaurants', 'AdminController@restaurants')->name('restaurants');
Route::get('/consumables', 'AdminController@consumables')->name('consumables');
