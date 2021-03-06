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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users');
Route::get('/locations', 'LocationsController@index')->name('locations');

Route::get('/product_list', 'ProductListController@index')->name('product_list');
Route::get('/product_list/{id}', 'ProductListController@show');
Route::post('/product_list', 'ProductListController@store');
Route::post('/product_list/{id}', 'ProductListController@update');
Route::delete('/product_list/{id}', 'ProductListController@destroy');

Route::get('/product_item_out', 'ProductItemOutController@index')->name('product_item_out');
Route::get('/product_item_out/{id}', 'ProductItemOutController@show');
Route::post('/product_item_out', 'ProductItemOutController@store');
Route::post('/product_item_out/{id}', 'ProductItemOutController@update');
Route::delete('/product_item_out/{id}', 'ProductItemOutController@destroy');

Route::get('/product_item', 'ProductItemController@index')->name('product_item');
Route::post('/product_item', 'ProductItemController@store');
