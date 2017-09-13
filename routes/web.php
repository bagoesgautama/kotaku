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
Route::get('/login', 'Auth\LoginController@showLoginForm');
//Route::post('/login', 'Auth\LoginController@dologin');
Route::get('/register', 'Auth\RegisterController@index');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/test', 'TestController@index');
Route::get('/index', 'HomeController@index');
Route::get('/blank', 'Blank@index');
Route::get('/test_table', 'TestTable@index');
Route::post('/test_posts', 'TestTable@Posts' );

//simple form CRUD
Route::get('/simple', 'Test\simple@index');
Route::get('/simple/create', 'Test\simple@create');
Route::get('/simple/{id}', 'Test\simple@show');
Route::post('/simple', 'Test\simple@post');
Route::put('/simple', 'Test\simple@put');
Route::delete('/simple', 'Test\simple@delete');

//wizard form CRUD
Route::get('/wizard', 'Test\wizard@index');
Route::get('/wizard/create', 'Test\wizard@create');
Route::get('/wizard/{id}', 'Test\wizard@show');
Route::post('/wizard', 'Test\wizard@post');
Route::put('/wizard', 'Test\wizard@put');
Route::delete('/wizard', 'Test\wizard@delete');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');
