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

//reigistrasi
Route::post('/registrasi', 'Registrasi\RegistrasiController@registrasi_create_post');

/**
 *
 *
 *module MAIN route here
 */
Route::get('/hrm', 'HomeController@hrm');
//get html form data
Route::get('/hrm/role', 'HRM\bk020102Controller@index');
//get data for datatable
Route::post('hrm/role', 'HRM\bk020102Controller@post');
//get html for form CRUD
Route::get('/hrm/role/create', 'HRM\bk020102Controller@create');
//insert or update data
Route::post('/hrm/role/create', 'HRM\bk020102Controller@post_create');
//delete data
Route::get('/hrm/role/delete', 'HRM\bk020102Controller@delete');

//role_level form CRUD
//get html form data
Route::get('/hrm/role_level', 'HRM\bk020101Controller@index');
//get data for datatable
Route::post('hrm/role_level', 'HRM\bk020101Controller@post');
//get html for form CRUD
Route::get('/hrm/role_level/create', 'HRM\bk020101Controller@create');
//insert or update data
Route::post('/hrm/role_level/create', 'HRM\bk020101Controller@post_create');
//delete data
Route::get('/hrm/role_level/delete', 'HRM\bk020101Controller@delete');

//modul form CRUD
//get html form data
Route::get('/hrm/modul', 'HRM\bk020104Controller@index');
//get data for datatable
Route::post('hrm/modul', 'HRM\bk020104Controller@post');
//get html for form CRUD
Route::get('/hrm/modul/create', 'HRM\bk020104Controller@create');
//insert or update data
Route::post('/hrm/modul/create', 'HRM\bk020104Controller@post_create');
//delete data
Route::get('/hrm/modul/delete', 'HRM\bk020104Controller@delete');

/**
 *
 *
 *module MAIN route here
 */
Route::get('/main', 'HomeController@main');

/**
 *
 *
 *module GIS route here
 */
Route::get('/gis', 'GIS\bk040101Controller@index');

//gis Provinsi
Route::get('/gis/provinsi', 'GIS\bk040102Controller@index');
Route::post('/gis/provinsi', 'GIS\bk040102Controller@post');
Route::get('/gis/provinsi/create', 'GIS\bk040102Controller@create');
Route::post('/gis/provinsi/create', 'GIS\bk040102Controller@post_create');
Route::get('/gis/provinsi/delete', 'GIS\bk040102Controller@delete');

//gis kota
Route::get('/gis/kota', 'GIS\bk040103Controller@index');
Route::post('/gis/kota', 'GIS\bk040103Controller@post');
Route::get('/gis/kota/create', 'GIS\bk040103Controller@create');
Route::post('/gis/kota/create', 'GIS\bk040103Controller@post_create');
Route::get('/gis/kota/delete', 'GIS\bk040103Controller@delete');

//gis kecamatan
Route::get('/gis/kecamatan', 'GIS\bk040104Controller@index');
Route::post('/gis/kecamatan', 'GIS\bk040104Controller@post');
Route::get('/gis/kecamatan/create', 'GIS\bk040104Controller@create');
Route::post('/gis/kecamatan/create', 'GIS\bk040104Controller@post_create');
Route::get('/gis/kecamatan/delete', 'GIS\bk040104Controller@delete');

//gis kelurahan
Route::get('/gis/kelurahan', 'GIS\bk040105Controller@index');
Route::post('/gis/kelurahan', 'GIS\bk040105Controller@post');
Route::get('/gis/kelurahan/create', 'GIS\bk040105Controller@create');
Route::post('/gis/kelurahan/create', 'GIS\bk040105Controller@post_create');
Route::get('/gis/kelurahan/delete', 'GIS\bk040105Controller@delete');

Auth::routes();
