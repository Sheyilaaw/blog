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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', function () {
        return 'admin only';
    });
});

Route::group(['middleware' => 'manager'], function () {
    Route::get('/manager', function () {
        return ' manager only';
    });
});

Route::get('/', function () {
    return view('welcome');
});


