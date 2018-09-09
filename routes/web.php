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
Route::get('/registered', function (){
    return view('layouts.registered');
})->name('home');

Route::get('/about', function (){
    return view('layouts.about');
})->name('about');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/locations', 'LocationsController@index')->name('locations');

Route::get('/product_list', 'ProductListController@index')->name('product_list');
Route::get('/product_list/{id}', 'ProductListController@show');
Route::post('/product_list', 'ProductListController@store');
Route::post('/product_list/{id}', 'ProductListController@update');
Route::delete('/product_list/{id}', 'ProductListController@destroy');

Route::get('/schedule', 'ScheduleController@index')->name('schedule');
Route::get('/schedule/{id}', 'ScheduleController@show');
Route::post('/schedule', 'ScheduleController@store');
Route::post('/schedule/{id}', 'ScheduleController@update');
Route::delete('/schedule/{id}', 'ScheduleController@destroy');

Route::get('/files_submitted', function (){
    // return view('layouts.product_list', ['products' => $products, 'item_types' => $item_types, 'item_statuses' => $item_status]);
    $reports = DB::table('messages')
                ->join('users', 'users.id', '=', 'messages.user_id')
                ->where('filename', '!=', '')
                ->orderBy('messages.created_at', 'DESC')
                ->get(['messages.filename as filename', 'users.name as name', 'messages.created_at as created_at', 'messages.path as path_name']);

    return view('layouts.reports', ['reports' => $reports]);
});

Route::get('/product_item_out', 'ProductItemOutController@index')->name('product_item_out');
Route::get('/product_item_out/{id}', 'ProductItemOutController@show');
Route::post('/product_item_out', 'ProductItemOutController@store');
Route::post('/product_item_out/{id}', 'ProductItemOutController@update');
Route::delete('/product_item_out/{id}', 'ProductItemOutController@destroy');

Route::get('/product_item', 'ProductItemController@index')->name('product_item');
Route::post('/product_item', 'ProductItemController@store');

Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');
Route::get('messages/list', 'ChatsController@fetchMessagesList');
Route::post('messages/upload_file', 'ChatsController@uploadFile');
Route::get('download_file', 'ChatsController@downloadFile')->name('download_file');

Route::get('files/{path_file}/{file}', function($path_file = null, $file = null) {
    $path = storage_path().'/files/uploads/'.$path_file.'/'.$file;
    if(file_exists($path)) {
        return Response::download($path);
    }
});
