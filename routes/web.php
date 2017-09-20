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
Route::get('/blank', 'Blank@index');
Route::get('/test_table', 'TestTable@index');
Route::post('/test_posts', 'TestTable@Posts' );

//simple form CRUD
//get html form data
Route::get('/simple', 'Test\simple@index');
//get data for datatable
Route::post('/simple', 'Test\simple@post');
//get html for form CRUD
Route::get('/simple/create', 'Test\simple@create');
//insert or update data
Route::post('/simple/create', 'Test\simple@post_create');
//delete data
Route::get('/simple/delete', 'Test\simple@delete');

//wizard form CRUD
Route::get('/wizard', 'Test\wizard@index');
Route::post('/wizard/create', 'Test\wizard@post_create');
Route::get('/wizard/create', 'Test\wizard@create');
Route::post('/wizard', 'Test\wizard@post');
Route::delete('/wizard', 'Test\wizard@delete');

Route::get('/map', 'HomeController@map');

//module HRM route here
Route::get('/hrm', 'HomeController@hrm');

//role form CRUD
//get html form data
Route::get('/hrm/role', 'HRM\main\role@index');
//get data for datatable
Route::post('hrm/role', 'HRM\main\role@post');
//get html for form CRUD
Route::get('/hrm/role/create', 'HRM\main\role@create');
//insert or update data
Route::post('/hrm/role/create', 'HRM\main\role@post_create');
//delete data
Route::get('/hrm/role/delete', 'HRM\main\role@delete');

//role_level form CRUD
//get html form data
Route::get('/hrm/role_level', 'HRM\main\role_level@index');
//get data for datatable
Route::post('hrm/role_level', 'HRM\main\role_level@post');
//get html for form CRUD
Route::get('/hrm/role_level/create', 'HRM\main\role_level@create');
//insert or update data
Route::post('/hrm/role_level/create', 'HRM\main\role_level@post_create');
//delete data
Route::get('/hrm/role_level/delete', 'HRM\main\role_level@delete');

//modul form CRUD
//get html form data
Route::get('/hrm/modul', 'HRM\main\modul@index');
//get data for datatable
Route::post('hrm/modul', 'HRM\main\modul@post');
//get html for form CRUD
Route::get('/hrm/modul/create', 'HRM\main\modul@create');
//insert or update data
Route::post('/hrm/modul/create', 'HRM\main\modul@post_create');
//delete data
Route::get('/hrm/modul/delete', 'HRM\main\modul@delete');

//module HRM route here
Route::get('/main', 'HomeController@main');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');
