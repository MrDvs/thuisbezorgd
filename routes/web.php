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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Profile routes
// Route::get('/profiel', 'ProfileController@show')->name('profile');
// Route::get('/profiel/bewerken', 'ProfileController@edit')->name('profile.edit');
// Route::patch('/profiel/update', 'ProfileController@update')->name('profile.update');
Route::resource('profile', 'ProfileController');

// Restaurant routes
Route::resource('restaurant', 'RestaurantController');
Route::get('restaurant/{restaurant_id}/afrekenen', 'RestaurantController@checkout')->name('checkout');
Route::get('restaurant/{restaurant_id}/betalen', 'RestaurantController@pay')->name('pay');
Route::resource('restaurant/{restaurant_id}/consumable', 'ConsumableController');

Route::get('addtocart/{id}', 'ConsumableController@addToCart')->name('cart.add');
Route::get('clearsession', 'ConsumableController@clearsession')->name('session.clear');

