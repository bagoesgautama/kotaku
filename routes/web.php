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


// Route::get('/', function () {
//     return view('index');
// });

// Route::get('{name?}', 'ClearController@showView');

Route::get('/', 'HomeController@index');
Route::get('/login', 'Auth\LoginController@index');
Route::get('/register', 'Auth\RegisterController@index');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/test', 'TestController@index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
