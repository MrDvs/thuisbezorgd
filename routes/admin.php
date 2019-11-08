<?php

// Admin tabs
Route::get('/', 'ProfileController@index')->name('admin');
Route::resource('restaurants', 'RestaurantController');
Route::resource('consumables', 'ConsumableController');
Route::resource('profiles', 'ProfileController');
Route::get('/{id}/orders', 'ProfileController@orders')->name('orders');
