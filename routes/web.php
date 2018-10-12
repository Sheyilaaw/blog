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

Route::resource('post', 'PostController')->only([
    'create','index','store'
]);

Route::group(['middleware' => ['admin', 'manager']], function () {
    Route::resource('post', 'PostController')->except([
        'create','index','store'
    ]);
});

Route::group(['middleware' => 'admin'], function () {

});

Route::get('/', function () {
    return view('welcome');
});


