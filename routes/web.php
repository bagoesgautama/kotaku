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
Route::get('/hrm/role_akses/show', 'HRM\bk020109Controller@show');
Route::post('/hrm/role_akses', 'HRM\bk020109Controller@post');

/**
 *
 *
 *module MAIN route here
 */
Route::get('/main', 'HomeController@main');

//master menu
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

//persiapan menu
//nasional
Route::get('/main/persiapan/nasional/pokja/pembentukan', 'MAIN\bk010201Controller@index');
Route::post('/main/persiapan/nasional/pokja/pembentukan', 'MAIN\bk010201Controller@post');
Route::get('/main/persiapan/nasional/pokja/pembentukan/create', 'MAIN\bk010201Controller@create');
Route::post('/main/persiapan/nasional/pokja/pembentukan/create', 'MAIN\bk010201Controller@post_create');
Route::get('/main/persiapan/nasional/pokja/pembentukan/delete', 'MAIN\bk010201Controller@delete');

Route::get('/main/persiapan/nasional/pokja/kegiatan', 'MAIN\bk010202Controller@index');
Route::post('/main/persiapan/nasional/pokja/kegiatan', 'MAIN\bk010202Controller@post');
Route::get('/main/persiapan/nasional/pokja/kegiatan/create', 'MAIN\bk010202Controller@create');
Route::post('/main/persiapan/nasional/pokja/kegiatan/create', 'MAIN\bk010202Controller@post_create');
Route::get('/main/persiapan/nasional/pokja/kegiatan/delete', 'MAIN\bk010202Controller@delete');

//propinsi
Route::get('/main/persiapan/propinsi/pokja/pembentukan', 'MAIN\bk010203Controller@index');
Route::post('/main/persiapan/propinsi/pokja/pembentukan', 'MAIN\bk010203Controller@post');
Route::get('/main/persiapan/propinsi/pokja/pembentukan/create', 'MAIN\bk010203Controller@create');
Route::post('/main/persiapan/propinsi/pokja/pembentukan/create', 'MAIN\bk010203Controller@post_create');
Route::get('/main/persiapan/propinsi/pokja/pembentukan/delete', 'MAIN\bk010203Controller@delete');

Route::get('/main/persiapan/propinsi/pokja/kegiatan', 'MAIN\bk010204Controller@index');
Route::post('/main/persiapan/propinsi/pokja/kegiatan', 'MAIN\bk010204Controller@post');
Route::get('/main/persiapan/propinsi/pokja/kegiatan/create', 'MAIN\bk010204Controller@create');
Route::post('/main/persiapan/propinsi/pokja/kegiatan/create', 'MAIN\bk010204Controller@post_create');
Route::get('/main/persiapan/propinsi/pokja/kegiatan/delete', 'MAIN\bk010204Controller@delete');

//kota
Route::get('/main/persiapan/kota/info', 'MAIN\bk010205Controller@index');
Route::post('/main/persiapan/kota/info', 'MAIN\bk010205Controller@post');
Route::get('/main/persiapan/kota/info/create', 'MAIN\bk010205Controller@create');
Route::post('/main/persiapan/kota/info/create', 'MAIN\bk010205Controller@post_create');
Route::get('/main/persiapan/kota/info/delete', 'MAIN\bk010205Controller@delete');

Route::get('/main/persiapan/kota/pokja/pembentukan', 'MAIN\bk010206Controller@index');
Route::post('/main/persiapan/kota/pokja/pembentukan', 'MAIN\bk010206Controller@post');
Route::get('/main/persiapan/kota/pokja/pembentukan/create', 'MAIN\bk010206Controller@create');
Route::post('/main/persiapan/kota/pokja/pembentukan/create', 'MAIN\bk010206Controller@post_create');
Route::get('/main/persiapan/kota/pokja/pembentukan/delete', 'MAIN\bk010206Controller@delete');

Route::get('/main/persiapan/kota/pokja/kegiatan', 'MAIN\bk010207Controller@index');
Route::post('/main/persiapan/kota/pokja/kegiatan', 'MAIN\bk010207Controller@post');
Route::get('/main/persiapan/kota/pokja/kegiatan/create', 'MAIN\bk010207Controller@create');
Route::post('/main/persiapan/kota/pokja/kegiatan/create', 'MAIN\bk010207Controller@post_create');
Route::get('/main/persiapan/kota/pokja/kegiatan/delete', 'MAIN\bk010207Controller@delete');

Route::get('/main/persiapan/kota/kegiatan/sosialisasi', 'MAIN\bk010208Controller@index');
Route::post('/main/persiapan/kota/kegiatan/sosialisasi', 'MAIN\bk010208Controller@post');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/create', 'MAIN\bk010208Controller@create');
Route::post('/main/persiapan/kota/kegiatan/sosialisasi/create', 'MAIN\bk010208Controller@post_create');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/delete', 'MAIN\bk010208Controller@delete');

Route::get('/main/persiapan/kota/forum/bkm', 'MAIN\bk010209Controller@index');
Route::post('/main/persiapan/kota/forum/bkm', 'MAIN\bk010209Controller@post');
Route::get('/main/persiapan/kota/forum/bkm/create', 'MAIN\bk010209Controller@create');
Route::post('/main/persiapan/kota/forum/bkm/create', 'MAIN\bk010209Controller@post_create');
Route::get('/main/persiapan/kota/forum/bkm/delete', 'MAIN\bk010209Controller@delete');

Route::get('/main/persiapan/kota/forum/kolaborasi', 'MAIN\bk010210Controller@index');
Route::post('/main/persiapan/kota/forum/kolaborasi', 'MAIN\bk010210Controller@post');
Route::get('/main/persiapan/kota/forum/kolaborasi/create', 'MAIN\bk010210Controller@create');
Route::post('/main/persiapan/kota/forum/kolaborasi/create', 'MAIN\bk010210Controller@post_create');
Route::get('/main/persiapan/kota/forum/kolaborasi/delete', 'MAIN\bk010210Controller@delete');

Route::get('/main/persiapan/kota/forum/f_forum', 'MAIN\bk010211Controller@index');
Route::post('/main/persiapan/kota/forum/f_forum', 'MAIN\bk010211Controller@post');
Route::get('/main/persiapan/kota/forum/f_forum/create', 'MAIN\bk010211Controller@create');
Route::post('/main/persiapan/kota/forum/f_forum/create', 'MAIN\bk010211Controller@post_create');
Route::get('/main/persiapan/kota/forum/f_forum/delete', 'MAIN\bk010211Controller@delete');

/**
 *
 *
 *module GIS route here
 */
Route::get('/gis', 'GIS\bk040101Controller@index');
Route::get('/gis/map-kota', 'GIS\bk040101Controller@kota');
Route::get('/gis/map-kecamatan', 'GIS\bk040101Controller@kecamatan');

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
