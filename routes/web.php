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
 *module HRM route here
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

//role akses form CRUD
Route::get('/hrm/role_akses', 'HRM\bk020109Controller@index');
Route::post('hrm/role_akses', 'HRM\bk020109Controller@post');
Route::get('/hrm/role_akses/create', 'HRM\bk020109Controller@create');
Route::post('/hrm/role_akses/create', 'HRM\bk020109Controller@post_create');
Route::get('/hrm/role_akses/delete', 'HRM\bk020109Controller@delete');

/**
 *
 *
 *module MAIN route here
 */
Route::get('/main', 'HomeController@main');

Route::get('/main/slum_program', 'MAIN\bk010107Controller@index');
Route::post('/main/slum_program', 'MAIN\bk010107Controller@post');
Route::get('/main/slum_program/create', 'MAIN\bk010107Controller@create');
Route::post('/main/slum_program/create', 'MAIN\bk010107Controller@post_create');
Route::get('/main/slum_program/delete', 'MAIN\bk010107Controller@delete');

Route::get('/main/kmp', 'MAIN\bk010108Controller@index');
Route::post('/main/kmp', 'MAIN\bk010108Controller@post');
Route::get('/main/kmp/create', 'MAIN\bk010108Controller@create');
Route::post('/main/kmp/create', 'MAIN\bk010108Controller@post_create');
Route::get('/main/kmp/delete', 'MAIN\bk010108Controller@delete');

Route::get('/main/kmp_slum_program', 'MAIN\bk010109Controller@index');
Route::post('/main/kmp_slum_program', 'MAIN\bk010109Controller@post');
Route::get('/main/kmp_slum_program/create', 'MAIN\bk010109Controller@create');
Route::post('/main/kmp_slum_program/create', 'MAIN\bk010109Controller@post_create');
Route::get('/main/kmp_slum_program/delete', 'MAIN\bk010109Controller@delete');

Route::get('/main/kmw', 'MAIN\bk010110Controller@index');
Route::post('/main/kmw', 'MAIN\bk010110Controller@post');
Route::get('/main/kmw/create', 'MAIN\bk010110Controller@create');
Route::post('/main/kmw/create', 'MAIN\bk010110Controller@post_create');
Route::get('/main/kmw/delete', 'MAIN\bk010110Controller@delete');

Route::get('/main/korkot', 'MAIN\bk010111Controller@index');
Route::post('/main/korkot', 'MAIN\bk010111Controller@post');
Route::get('/main/korkot/create', 'MAIN\bk010111Controller@create');
Route::post('/main/korkot/create', 'MAIN\bk010111Controller@post_create');
Route::get('/main/korkot/delete', 'MAIN\bk010111Controller@delete');

Route::get('/main/kota_korkot', 'MAIN\bk010112Controller@index');
Route::post('/main/kota_korkot', 'MAIN\bk010112Controller@post');
Route::get('/main/kota_korkot/create', 'MAIN\bk010112Controller@create');
Route::post('/main/kota_korkot/create', 'MAIN\bk010112Controller@post_create');
Route::get('/main/kota_korkot/delete', 'MAIN\bk010112Controller@delete');

Route::get('/main/faskel', 'MAIN\bk010113Controller@index');
Route::post('/main/faskel', 'MAIN\bk010113Controller@post');
Route::get('/main/faskel/create', 'MAIN\bk010113Controller@create');
Route::post('/main/faskel/create', 'MAIN\bk010113Controller@post_create');
Route::get('/main/faskel/delete', 'MAIN\bk010113Controller@delete');

Route::get('/main/kel_faskel', 'MAIN\bk010114Controller@index');
Route::post('/main/kel_faskel', 'MAIN\bk010114Controller@post');
Route::get('/main/kel_faskel/create', 'MAIN\bk010114Controller@create');
Route::post('/main/kel_faskel/create', 'MAIN\bk010114Controller@post_create');
Route::get('/main/kel_faskel/delete', 'MAIN\bk010114Controller@delete');

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
