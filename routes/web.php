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
Route::post('/product_list', 'ProductListController@store');

Route::get('/product_item', 'ProductItemController@index')->name('product_item');
Route::post('/product_item', 'ProductItemController@store');
