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
    return view('welcome');
});

// Route::get('/search', 'SearchController@normal');
Route::get('{s?}/{qUrl}', 'SearchController@normal')->where('qUrl', '.*');
Route::get('/{qUrl}', 'SearchController@normal')->where('qUrl', '.*');
