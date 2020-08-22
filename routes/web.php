<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'noLogin'], function () {
    Route::get('/', 'PageController@index');
    Route::post('/login', 'LoginController@authenticate');
    Route::get('/register', 'PageController@register');
    Route::post('/register', 'UserController@insert');
});

Route::group(['middleware' => 'checkLogin'], function () {
    Route::get('/home', 'PageController@home');
    Route::get('/logout', 'LoginController@logout');
    Route::get('/message/{id}', 'PageController@getMessage');
    Route::post('/message', 'PageController@sendMessage');
});