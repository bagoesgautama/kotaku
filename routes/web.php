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
Route::get('/register/select', 'Auth\RegisterController@select');
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

//get message
Route::get('/inbox', 'HomeController@inbox');
/**
 *
 *
 *module HRM route here
 */
Route::get('/hrm', 'HomeController@hrm');

//activity log
Route::get('/hrm/activity_log', 'HRM\bk020201Controller@index');
Route::post('hrm/activity_log', 'HRM\bk020201Controller@post');
Route::get('/hrm/activity_log/create', 'HRM\bk020201Controller@create');
Route::post('/hrm/activity_log/create', 'HRM\bk020201Controller@post_create');
Route::get('/hrm/activity_log/delete', 'HRM\bk020201Controller@delete');

//management
Route::get('/hrm/profil/user/aktivasi', 'HRM\bk020302Controller@index');
Route::post('/hrm/profil/user/aktivasi', 'HRM\bk020302Controller@post');

Route::get('/hrm/profil/user/profil', 'HRM\bk020312Controller@index');
Route::post('/hrm/profil/user/profil', 'HRM\bk020312Controller@post');

Route::get('/hrm/profil/pesan', 'HRM\bk020301Controller@index');
Route::post('/hrm/profil/pesan', 'HRM\bk020301Controller@post');
Route::get('/hrm/profil/pesan/baca', 'HRM\bk020301Controller@baca');
Route::get('/hrm/profil/pesan/delete', 'HRM\bk020301Controller@delete');

Route::get('/hrm/profil/user/pelatihan', 'HRM\bk020303Controller@index');
Route::post('hrm/profil/user/pelatihan', 'HRM\bk020303Controller@post');
Route::get('/hrm/profil/user/pelatihan/create', 'HRM\bk020303Controller@create');
Route::post('/hrm/profil/user/pelatihan/create', 'HRM\bk020303Controller@post_create');
Route::get('/hrm/profil/user/pelatihan/delete', 'HRM\bk020303Controller@delete');

Route::get('/hrm/profil/user/pendidikan', 'HRM\bk020304Controller@index');
Route::post('hrm/profil/user/pendidikan', 'HRM\bk020304Controller@post');
Route::get('/hrm/profil/user/pendidikan/create', 'HRM\bk020304Controller@create');
Route::post('/hrm/profil/user/pendidikan/create', 'HRM\bk020304Controller@post_create');
Route::get('/hrm/profil/user/pendidikan/delete', 'HRM\bk020304Controller@delete');

Route::get('/hrm/profil/user/penghargaan', 'HRM\bk020305Controller@index');
Route::post('hrm/profil/user/penghargaan', 'HRM\bk020305Controller@post');
Route::get('/hrm/profil/user/penghargaan/create', 'HRM\bk020305Controller@create');
Route::post('/hrm/profil/user/penghargaan/create', 'HRM\bk020305Controller@post_create');
Route::get('/hrm/profil/user/penghargaan/delete', 'HRM\bk020305Controller@delete');

Route::get('/hrm/profil/user/password', 'HRM\bk020307Controller@index');
Route::post('hrm/profil/user/password', 'HRM\bk020307Controller@post');

Route::get('/hrm/management/user/blacklist', 'HRM\bk020308Controller@index');
Route::post('/hrm/management/user/blacklist', 'HRM\bk020308Controller@post');
Route::get('/hrm/management/user/blacklist/create', 'HRM\bk020308Controller@create');
Route::post('/hrm/management/user/blacklist/create', 'HRM\bk020308Controller@post_create');

Route::get('/hrm/management/kuota/kmp', 'HRM\bk020309Controller@index');
Route::post('hrm/management/kuota/kmp', 'HRM\bk020309Controller@post');
Route::get('/hrm/management/kuota/kmp/create', 'HRM\bk020309Controller@create');
Route::post('/hrm/management/kuota/kmp/create', 'HRM\bk020309Controller@post_create');
Route::get('/hrm/management/kuota/kmp/delete', 'HRM\bk020309Controller@delete');

Route::get('/hrm/management/kuota/kmw', 'HRM\bk020310Controller@index');
Route::post('hrm/management/kuota/kmw', 'HRM\bk020310Controller@post');
Route::get('/hrm/management/kuota/kmw/create', 'HRM\bk020310Controller@create');
Route::post('/hrm/management/kuota/kmw/create', 'HRM\bk020310Controller@post_create');
Route::get('/hrm/management/kuota/kmw/delete', 'HRM\bk020310Controller@delete');

Route::get('/hrm/management/kuota/korkot', 'HRM\bk020311Controller@index');
Route::post('hrm/management/kuota/korkot', 'HRM\bk020311Controller@post');
Route::get('/hrm/management/kuota/korkot/create', 'HRM\bk020311Controller@create');
Route::post('/hrm/management/kuota/korkot/create', 'HRM\bk020311Controller@post_create');
Route::get('/hrm/management/kuota/korkot/delete', 'HRM\bk020311Controller@delete');

Route::get('/hrm/management/peringatan', 'HRM\bk020313Controller@index');
Route::post('hrm/management/peringatan', 'HRM\bk020313Controller@post');
Route::get('/hrm/management/peringatan/create', 'HRM\bk020313Controller@create');
Route::post('/hrm/management/peringatan/create', 'HRM\bk020313Controller@post_create');
Route::get('/hrm/management/peringatan/delete', 'HRM\bk020313Controller@delete');

Route::get('/hrm/management/evaluasi', 'HRM\bk020314Controller@index');
Route::post('hrm/management/evaluasi', 'HRM\bk020314Controller@post');
Route::get('/hrm/management/evaluasi/create', 'HRM\bk020314Controller@create');
Route::post('/hrm/management/evaluasi/create', 'HRM\bk020314Controller@post_create');
Route::get('/hrm/management/evaluasi/delete', 'HRM\bk020314Controller@delete');

Route::get('/hrm/management/sidang', 'HRM\bk020315Controller@index');
Route::post('hrm/management/sidang', 'HRM\bk020315Controller@post');
Route::get('/hrm/management/sidang/create', 'HRM\bk020315Controller@create');
Route::post('/hrm/management/sidang/create', 'HRM\bk020315Controller@post_create');
Route::get('/hrm/management/sidang/delete', 'HRM\bk020315Controller@delete');

//get html form data
Route::get('/hrm/admin/role', 'HRM\bk020102Controller@index');
//get data for datatable
Route::post('hrm/admin/role', 'HRM\bk020102Controller@post');
//get html for form CRUD
Route::get('/hrm/admin/role/create', 'HRM\bk020102Controller@create');
//insert or update data
Route::post('/hrm/admin/role/create', 'HRM\bk020102Controller@post_create');
//delete data
Route::get('/hrm/admin/role/delete', 'HRM\bk020102Controller@delete');

//role_level form CRUD
//get html form data
Route::get('/hrm/admin/role_level', 'HRM\bk020101Controller@index');
//get data for datatable
Route::post('hrm/admin/role_level', 'HRM\bk020101Controller@post');
//get html for form CRUD
Route::get('/hrm/admin/role_level/create', 'HRM\bk020101Controller@create');
//insert or update data
Route::post('/hrm/admin/role_level/create', 'HRM\bk020101Controller@post_create');
//delete data
Route::get('/hrm/admin/role_level/delete', 'HRM\bk020101Controller@delete');

//role akses form CRUD
Route::get('/hrm/admin/role_akses', 'HRM\bk020109Controller@index');
Route::get('/hrm/admin/role_akses/show', 'HRM\bk020109Controller@show');
Route::post('/hrm/admin/role_akses', 'HRM\bk020109Controller@post');

//get html form data
Route::get('/hrm/admin/registrasi_manual', 'HRM\bk020111Controller@index');
//get data for datatable
Route::post('hrm/admin/registrasi_manual', 'HRM\bk020111Controller@post');
//get html for form CRUD
Route::get('/hrm/admin/registrasi_manual/create', 'HRM\bk020111Controller@create');
//insert or update data
Route::post('/hrm/admin/registrasi_manual/create', 'HRM\bk020111Controller@post_create');
//delete data
Route::get('/hrm/admin/registrasi_manual/delete', 'HRM\bk020111Controller@delete');
/**
 *
 *
 *module MAIN route here
 */
Route::get('/main', 'HomeController@main');

//master data
//wilayah
Route::get('/main/data_wilayah/provinsi', 'MAIN\bk010101Controller@index');
Route::post('/main/data_wilayah/provinsi', 'MAIN\bk010101Controller@post');
Route::get('/main/data_wilayah/provinsi/create', 'MAIN\bk010101Controller@create');
Route::post('/main/data_wilayah/provinsi/create', 'MAIN\bk010101Controller@post_create');
Route::get('/main/data_wilayah/provinsi/delete', 'MAIN\bk010101Controller@delete');

Route::get('/main/data_wilayah/kota', 'MAIN\bk010102Controller@index');
Route::post('/main/data_wilayah/kota', 'MAIN\bk010102Controller@post');
Route::get('/main/data_wilayah/kota/create', 'MAIN\bk010102Controller@create');
Route::post('/main/data_wilayah/kota/create', 'MAIN\bk010102Controller@post_create');
Route::get('/main/data_wilayah/kota/delete', 'MAIN\bk010102Controller@delete');

Route::get('/main/data_wilayah/kecamatan', 'MAIN\bk010103Controller@index');
Route::post('/main/data_wilayah/kecamatan', 'MAIN\bk010103Controller@post');
Route::get('/main/data_wilayah/kecamatan/create', 'MAIN\bk010103Controller@create');
Route::post('/main/data_wilayah/kecamatan/create', 'MAIN\bk010103Controller@post_create');
Route::get('/main/data_wilayah/kecamatan/delete', 'MAIN\bk010103Controller@delete');

Route::get('/main/data_wilayah/kelurahan', 'MAIN\bk010104Controller@index');
Route::post('/main/data_wilayah/kelurahan', 'MAIN\bk010104Controller@post');
Route::get('/main/data_wilayah/kelurahan/create', 'MAIN\bk010104Controller@create');
Route::post('/main/data_wilayah/kelurahan/create', 'MAIN\bk010104Controller@post_create');
Route::get('/main/data_wilayah/kelurahan/delete', 'MAIN\bk010104Controller@delete');

Route::get('/main/data_wilayah/rt', 'MAIN\bk010105Controller@index');
Route::post('/main/data_wilayah/rt', 'MAIN\bk010105Controller@post');
Route::get('/main/data_wilayah/rt/create', 'MAIN\bk010105Controller@create');
Route::post('/main/data_wilayah/rt/create', 'MAIN\bk010105Controller@post_create');
Route::get('/main/data_wilayah/rt/delete', 'MAIN\bk010105Controller@delete');

//master cakupan program
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
Route::get('/main/kel_faskel/select', 'MAIN\bk010114Controller@select');
Route::post('/main/kel_faskel', 'MAIN\bk010114Controller@post');
Route::get('/main/kel_faskel/create', 'MAIN\bk010114Controller@create');
Route::post('/main/kel_faskel/create', 'MAIN\bk010114Controller@post_create');
Route::get('/main/kel_faskel/delete', 'MAIN\bk010114Controller@delete');

Route::get('/main/data_master/pms', 'MAIN\bk010115Controller@index');
Route::post('/main/data_master/pms', 'MAIN\bk010115Controller@post');
Route::get('/main/data_master/pms/create', 'MAIN\bk010115Controller@create');
Route::post('/main/data_master/pms/create', 'MAIN\bk010115Controller@post_create');
Route::get('/main/data_master/pms/delete', 'MAIN\bk010115Controller@delete');

Route::get('/main/data_master/keg_pelatihan', 'MAIN\bk010116Controller@index');
Route::post('/main/data_master/keg_pelatihan', 'MAIN\bk010116Controller@post');
Route::get('/main/data_master/keg_pelatihan/create', 'MAIN\bk010116Controller@create');
Route::post('/main/data_master/keg_pelatihan/create', 'MAIN\bk010116Controller@post_create');
Route::get('/main/data_master/keg_pelatihan/delete', 'MAIN\bk010116Controller@delete');

Route::get('/main/data_master/keg_kelurahan', 'MAIN\bk010117Controller@index');
Route::post('/main/data_master/keg_kelurahan', 'MAIN\bk010117Controller@post');
Route::get('/main/data_master/keg_kelurahan/create', 'MAIN\bk010117Controller@create');
Route::post('/main/data_master/keg_kelurahan/create', 'MAIN\bk010117Controller@post_create');
Route::get('/main/data_master/keg_kelurahan/delete', 'MAIN\bk010117Controller@delete');

Route::get('/main/data_master/det_keg_kelurahan', 'MAIN\bk010118Controller@index');
Route::post('/main/data_master/det_keg_kelurahan', 'MAIN\bk010118Controller@post');
Route::get('/main/data_master/det_keg_kelurahan/create', 'MAIN\bk010118Controller@create');
Route::post('/main/data_master/det_keg_kelurahan/create', 'MAIN\bk010118Controller@post_create');
Route::get('/main/data_master/det_keg_kelurahan/delete', 'MAIN\bk010118Controller@delete');

Route::get('/main/data_master/sub_komp_keg', 'MAIN\bk010119Controller@index');
Route::post('/main/data_master/sub_komp_keg', 'MAIN\bk010119Controller@post');
Route::get('/main/data_master/sub_komp_keg/create', 'MAIN\bk010119Controller@create');
Route::post('/main/data_master/sub_komp_keg/create', 'MAIN\bk010119Controller@post_create');
Route::get('/main/data_master/sub_komp_keg/delete', 'MAIN\bk010119Controller@delete');

Route::get('/main/data_master/det_komp_keg', 'MAIN\bk010120Controller@index');
Route::post('/main/data_master/det_komp_keg', 'MAIN\bk010120Controller@post');
Route::get('/main/data_master/det_komp_keg/create', 'MAIN\bk010120Controller@create');
Route::post('/main/data_master/det_komp_keg/create', 'MAIN\bk010120Controller@post_create');
Route::get('/main/data_master/det_komp_keg/delete', 'MAIN\bk010120Controller@delete');

Route::get('/main/data_master/aspek_kumuh', 'MAIN\bk010121Controller@index');
Route::post('/main/data_master/aspek_kumuh', 'MAIN\bk010121Controller@post');
Route::get('/main/data_master/aspek_kumuh/create', 'MAIN\bk010121Controller@create');
Route::post('/main/data_master/aspek_kumuh/create', 'MAIN\bk010121Controller@post_create');
Route::get('/main/data_master/aspek_kumuh/delete', 'MAIN\bk010121Controller@delete');

Route::get('/main/data_master/kontraktor', 'MAIN\bk010122Controller@index');
Route::get('/main/data_master/kontraktor/select', 'MAIN\bk010122Controller@select');
Route::post('/main/data_master/kontraktor', 'MAIN\bk010122Controller@post');
Route::get('/main/data_master/kontraktor/create', 'MAIN\bk010122Controller@create');
Route::post('/main/data_master/kontraktor/create', 'MAIN\bk010122Controller@post_create');
Route::get('/main/data_master/kontraktor/delete', 'MAIN\bk010122Controller@delete');

Route::get('/main/data_master/keg_rplp', 'MAIN\bk010123Controller@index');
Route::get('/main/data_master/keg_rplp/select', 'MAIN\bk010123Controller@select');
Route::post('/main/data_master/keg_rplp', 'MAIN\bk010123Controller@post');
Route::get('/main/data_master/keg_rplp/create', 'MAIN\bk010123Controller@create');
Route::post('/main/data_master/keg_rplp/create', 'MAIN\bk010123Controller@post_create');
Route::get('/main/data_master/keg_rplp/delete', 'MAIN\bk010123Controller@delete');

Route::get('/main/data_master/bkm', 'MAIN\bk010124Controller@index');
Route::get('/main/data_master/bkm/select', 'MAIN\bk010124Controller@select');
Route::post('/main/data_master/bkm', 'MAIN\bk010124Controller@post');
Route::get('/main/data_master/bkm/create', 'MAIN\bk010124Controller@create');
Route::post('/main/data_master/bkm/create', 'MAIN\bk010124Controller@post_create');
Route::get('/main/data_master/bkm/delete', 'MAIN\bk010124Controller@delete');

Route::get('/main/data_master/ksm', 'MAIN\bk010125Controller@index');
Route::post('/main/data_master/ksm', 'MAIN\bk010125Controller@post');
Route::get('/main/data_master/ksm/create', 'MAIN\bk010125Controller@create');
Route::post('/main/data_master/ksm/create', 'MAIN\bk010125Controller@post_create');
Route::get('/main/data_master/ksm/delete', 'MAIN\bk010125Controller@delete');

Route::get('/main/data_master/kpp', 'MAIN\bk010126Controller@index');
Route::get('/main/data_master/kpp/select', 'MAIN\bk010126Controller@select');
Route::post('/main/data_master/kpp', 'MAIN\bk010126Controller@post');
Route::get('/main/data_master/kpp/create', 'MAIN\bk010126Controller@create');
Route::post('/main/data_master/kpp/create', 'MAIN\bk010126Controller@post_create');
Route::get('/main/data_master/kpp/delete', 'MAIN\bk010126Controller@delete');

Route::get('/main/data_master/unsur', 'MAIN\bk010127Controller@index');
Route::get('/main/data_master/unsur/select', 'MAIN\bk010127Controller@select');
Route::post('/main/data_master/unsur', 'MAIN\bk010127Controller@post');
Route::get('/main/data_master/unsur/create', 'MAIN\bk010127Controller@create');
Route::post('/main/data_master/unsur/create', 'MAIN\bk010127Controller@post_create');
Route::get('/main/data_master/unsur/delete', 'MAIN\bk010127Controller@delete');

Route::get('/main/data_master/pemanfaatan', 'MAIN\bk010128Controller@index');
Route::get('/main/data_master/pemanfaatan/select', 'MAIN\bk010128Controller@select');
Route::post('/main/data_master/pemanfaatan', 'MAIN\bk010128Controller@post');
Route::get('/main/data_master/pemanfaatan/create', 'MAIN\bk010128Controller@create');
Route::post('/main/data_master/pemanfaatan/create', 'MAIN\bk010128Controller@post_create');
Route::get('/main/data_master/pemanfaatan/delete', 'MAIN\bk010128Controller@delete');

//persiapan menu
//nasional
Route::get('/main/persiapan/nasional/pokja/pembentukan', 'MAIN\bk010201Controller@index');
Route::get('/main/persiapan/nasional/pokja/pembentukan/select', 'MAIN\bk010201Controller@select');
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
Route::get('/main/persiapan/propinsi/pokja/pembentukan/select', 'MAIN\bk010203Controller@select');
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
Route::get('/main/persiapan/kota/pokja/pembentukan/select', 'MAIN\bk010206Controller@select');
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
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/select', 'MAIN\bk010208Controller@select');
Route::post('/main/persiapan/kota/kegiatan/sosialisasi', 'MAIN\bk010208Controller@post');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/create', 'MAIN\bk010208Controller@create');
Route::post('/main/persiapan/kota/kegiatan/sosialisasi/create', 'MAIN\bk010208Controller@post_create');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/delete', 'MAIN\bk010208Controller@delete');

Route::get('/main/persiapan/kota/forum/bkm', 'MAIN\bk010209Controller@index');
Route::get('/main/persiapan/kota/forum/bkm/select', 'MAIN\bk010209Controller@select');
Route::post('/main/persiapan/kota/forum/bkm', 'MAIN\bk010209Controller@post');
Route::get('/main/persiapan/kota/forum/bkm/create', 'MAIN\bk010209Controller@create');
Route::post('/main/persiapan/kota/forum/bkm/create', 'MAIN\bk010209Controller@post_create');
Route::get('/main/persiapan/kota/forum/bkm/delete', 'MAIN\bk010209Controller@delete');

Route::get('/main/persiapan/kota/forum/kolaborasi', 'MAIN\bk010210Controller@index');
Route::get('/main/persiapan/kota/forum/kolaborasi/select', 'MAIN\bk010210Controller@select');
Route::post('/main/persiapan/kota/forum/kolaborasi', 'MAIN\bk010210Controller@post');
Route::get('/main/persiapan/kota/forum/kolaborasi/create', 'MAIN\bk010210Controller@create');
Route::post('/main/persiapan/kota/forum/kolaborasi/create', 'MAIN\bk010210Controller@post_create');
Route::get('/main/persiapan/kota/forum/kolaborasi/delete', 'MAIN\bk010210Controller@delete');

Route::get('/main/persiapan/kota/forum/f_forum', 'MAIN\bk010211Controller@index');
Route::post('/main/persiapan/kota/forum/f_forum', 'MAIN\bk010211Controller@post');
Route::get('/main/persiapan/kota/forum/f_forum/create', 'MAIN\bk010211Controller@create');
Route::post('/main/persiapan/kota/forum/f_forum/create', 'MAIN\bk010211Controller@post_create');
Route::get('/main/persiapan/kota/forum/f_forum/delete', 'MAIN\bk010211Controller@delete');

//kecamatan
Route::get('/main/persiapan/kecamatan/bkm', 'MAIN\bk010212Controller@index');
Route::get('/main/persiapan/kecamatan/bkm/select', 'MAIN\bk010212Controller@select');
Route::post('/main/persiapan/kecamatan/bkm', 'MAIN\bk010212Controller@post');
Route::get('/main/persiapan/kecamatan/bkm/create', 'MAIN\bk010212Controller@create');
Route::post('/main/persiapan/kecamatan/bkm/create', 'MAIN\bk010212Controller@post_create');
Route::get('/main/persiapan/kecamatan/bkm/delete', 'MAIN\bk010212Controller@delete');

Route::get('/main/persiapan/kecamatan/kolaborasi', 'MAIN\bk010213Controller@index');
Route::get('/main/persiapan/kecamatan/kolaborasi/select', 'MAIN\bk010213Controller@select');
Route::post('/main/persiapan/kecamatan/kolaborasi', 'MAIN\bk010213Controller@post');
Route::get('/main/persiapan/kecamatan/kolaborasi/create', 'MAIN\bk010213Controller@create');
Route::post('/main/persiapan/kecamatan/kolaborasi/create', 'MAIN\bk010213Controller@post_create');
Route::get('/main/persiapan/kecamatan/kolaborasi/delete', 'MAIN\bk010213Controller@delete');

Route::get('/main/persiapan/kecamatan/keberfungsian', 'MAIN\bk010214Controller@index');
Route::post('/main/persiapan/kecamatan/keberfungsian', 'MAIN\bk010214Controller@post');
Route::get('/main/persiapan/kecamatan/keberfungsian/create', 'MAIN\bk010214Controller@create');
Route::post('/main/persiapan/kecamatan/keberfungsian/create', 'MAIN\bk010214Controller@post_create');
Route::get('/main/persiapan/kecamatan/keberfungsian/delete', 'MAIN\bk010214Controller@delete');

//kelurahan
Route::get('/main/persiapan/kelurahan/info', 'MAIN\bk010215Controller@index');
Route::get('/main/persiapan/kelurahan/info/select', 'MAIN\bk010215Controller@select');
Route::post('/main/persiapan/kelurahan/info', 'MAIN\bk010215Controller@post');
Route::get('/main/persiapan/kelurahan/info/create', 'MAIN\bk010215Controller@create');
Route::post('/main/persiapan/kelurahan/info/create', 'MAIN\bk010215Controller@post_create');
Route::get('/main/persiapan/kelurahan/info/delete', 'MAIN\bk010215Controller@delete');

Route::get('/main/persiapan/kelurahan/sosialisasi', 'MAIN\bk010216Controller@index');
Route::get('/main/persiapan/kelurahan/sosialisasi/select', 'MAIN\bk010216Controller@select');
Route::post('/main/persiapan/kelurahan/sosialisasi', 'MAIN\bk010216Controller@post');
Route::get('/main/persiapan/kelurahan/sosialisasi/create', 'MAIN\bk010216Controller@create');
Route::post('/main/persiapan/kelurahan/sosialisasi/create', 'MAIN\bk010216Controller@post_create');
Route::get('/main/persiapan/kelurahan/sosialisasi/delete', 'MAIN\bk010216Controller@delete');

Route::get('/main/persiapan/kelurahan/relawan', 'MAIN\bk010217Controller@index');
Route::get('/main/persiapan/kelurahan/relawan/select', 'MAIN\bk010217Controller@select');
Route::post('/main/persiapan/kelurahan/relawan', 'MAIN\bk010217Controller@post');
Route::get('/main/persiapan/kelurahan/relawan/create', 'MAIN\bk010217Controller@create');
Route::post('/main/persiapan/kelurahan/relawan/create', 'MAIN\bk010217Controller@post_create');
Route::get('/main/persiapan/kelurahan/relawan/delete', 'MAIN\bk010217Controller@delete');

Route::get('/main/persiapan/kelurahan/agen_sosialisasi', 'MAIN\bk010218Controller@index');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/select', 'MAIN\bk010218Controller@select');
Route::post('/main/persiapan/kelurahan/agen_sosialisasi', 'MAIN\bk010218Controller@post');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/create', 'MAIN\bk010218Controller@create');
Route::post('/main/persiapan/kelurahan/agen_sosialisasi/create', 'MAIN\bk010218Controller@post_create');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/delete', 'MAIN\bk010218Controller@delete');

Route::get('/main/persiapan/kelurahan/pelatihan', 'MAIN\bk010219Controller@index');
Route::get('/main/persiapan/kelurahan/pelatihan/select', 'MAIN\bk010219Controller@select');
Route::post('/main/persiapan/kelurahan/pelatihan', 'MAIN\bk010219Controller@post');
Route::get('/main/persiapan/kelurahan/pelatihan/create', 'MAIN\bk010219Controller@create');
Route::post('/main/persiapan/kelurahan/pelatihan/create', 'MAIN\bk010219Controller@post_create');
Route::get('/main/persiapan/kelurahan/pelatihan/delete', 'MAIN\bk010219Controller@delete');

Route::get('/main/persiapan/kelurahan/forum/keanggotaan', 'MAIN\bk010220Controller@index');
Route::post('/main/persiapan/kelurahan/forum/keanggotaan', 'MAIN\bk010220Controller@post');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/create', 'MAIN\bk010220Controller@create');
Route::post('/main/persiapan/kelurahan/forum/keanggotaan/create', 'MAIN\bk010220Controller@post_create');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/delete', 'MAIN\bk010220Controller@delete');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/select', 'MAIN\bk010220Controller@select');

Route::get('/main/persiapan/kelurahan/forum/keberfungsian', 'MAIN\bk010221Controller@index');
Route::post('/main/persiapan/kelurahan/forum/keberfungsian', 'MAIN\bk010221Controller@post');
Route::get('/main/persiapan/kelurahan/forum/keberfungsian/create', 'MAIN\bk010221Controller@create');
Route::post('/main/persiapan/kelurahan/forum/keberfungsian/create', 'MAIN\bk010221Controller@post_create');
Route::get('/main/persiapan/kelurahan/forum/keberfungsian/delete', 'MAIN\bk010221Controller@delete');

Route::get('/main/persiapan/kelurahan/pemilu_bkm', 'MAIN\bk010222Controller@index');
Route::post('/main/persiapan/kelurahan/pemilu_bkm', 'MAIN\bk010222Controller@post');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/create', 'MAIN\bk010222Controller@create');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/create', 'MAIN\bk010222Controller@post_create');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/delete', 'MAIN\bk010222Controller@delete');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/select', 'MAIN\bk010222Controller@select');

Route::get('/main/persiapan/kelurahan/lembaga', 'MAIN\bk010223Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga', 'MAIN\bk010223Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/create', 'MAIN\bk010223Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/create', 'MAIN\bk010223Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/delete', 'MAIN\bk010223Controller@delete');
Route::get('/main/persiapan/kelurahan/lembaga/select', 'MAIN\bk010223Controller@select');


//perencanaan
Route::get('/main/perencanaan/penanganan/pembangunan_visi', 'MAIN\bk010301Controller@index');
Route::get('/main/perencanaan/penanganan/pembangunan_visi/select', 'MAIN\bk010301Controller@select');
Route::post('/main/perencanaan/penanganan/pembangunan_visi', 'MAIN\bk010301Controller@post');
Route::get('/main/perencanaan/penanganan/pembangunan_visi/create', 'MAIN\bk010301Controller@create');
Route::post('/main/perencanaan/penanganan/pembangunan_visi/create', 'MAIN\bk010301Controller@post_create');
Route::get('/main/perencanaan/penanganan/pembangunan_visi/delete', 'MAIN\bk010301Controller@delete');

Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk', 'MAIN\bk010302Controller@index');
Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/select', 'MAIN\bk010302Controller@select');
Route::post('/main/perencanaan/penanganan/pelaksanaan_rpk', 'MAIN\bk010302Controller@post');
Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/create', 'MAIN\bk010302Controller@create');
Route::post('/main/perencanaan/penanganan/pelaksanaan_rpk/create', 'MAIN\bk010302Controller@post_create');
Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/delete', 'MAIN\bk010302Controller@delete');

Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan', 'MAIN\bk010303Controller@index');
Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/select', 'MAIN\bk010303Controller@select');
Route::post('/main/perencanaan/penanganan/lokakarya_perencanaan', 'MAIN\bk010303Controller@post');
Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/create', 'MAIN\bk010303Controller@create');
Route::post('/main/perencanaan/penanganan/lokakarya_perencanaan/create', 'MAIN\bk010303Controller@post_create');
Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/delete', 'MAIN\bk010303Controller@delete');

Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan', 'MAIN\bk010304Controller@index');
Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/select', 'MAIN\bk010304Controller@select');
Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/select', 'MAIN\bk010304Controller@select');
Route::post('/main/perencanaan/penanganan/konsultasi_perencanaan', 'MAIN\bk010304Controller@post');
Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/create', 'MAIN\bk010304Controller@create');
Route::post('/main/perencanaan/penanganan/konsultasi_perencanaan/create', 'MAIN\bk010304Controller@post_create');
Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/delete', 'MAIN\bk010304Controller@delete');

Route::get('/main/perencanaan/penanganan/lokasi_profile', 'MAIN\bk010305Controller@index');
Route::get('/main/perencanaan/penanganan/lokasi_profile/select', 'MAIN\bk010305Controller@select');
Route::post('/main/perencanaan/penanganan/lokasi_profile', 'MAIN\bk010305Controller@post');
Route::get('/main/perencanaan/penanganan/lokasi_profile/create', 'MAIN\bk010305Controller@create');
Route::post('/main/perencanaan/penanganan/lokasi_profile/create', 'MAIN\bk010305Controller@post_create');
Route::get('/main/perencanaan/penanganan/lokasi_profile/delete', 'MAIN\bk010305Controller@delete');

Route::get('/main/perencanaan/penanganan/profile_rencana_5thn', 'MAIN\bk010306Controller@index');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/select', 'MAIN\bk010306Controller@select');
Route::post('/main/perencanaan/penanganan/profile_rencana_5thn', 'MAIN\bk010306Controller@post');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/create', 'MAIN\bk010306Controller@create');
Route::post('/main/perencanaan/penanganan/profile_rencana_5thn/create', 'MAIN\bk010306Controller@post_create');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/delete', 'MAIN\bk010306Controller@delete');

Route::get('/main/perencanaan/penanganan/rencana_investasi', 'MAIN\bk010307Controller@index');
Route::get('/main/perencanaan/penanganan/rencana_investasi/select', 'MAIN\bk010307Controller@select');
Route::post('/main/perencanaan/penanganan/rencana_investasi', 'MAIN\bk010307Controller@post');
Route::get('/main/perencanaan/penanganan/rencana_investasi/create', 'MAIN\bk010307Controller@create');
Route::post('/main/perencanaan/penanganan/rencana_investasi/create', 'MAIN\bk010307Controller@post_create');
Route::get('/main/perencanaan/penanganan/rencana_investasi/delete', 'MAIN\bk010307Controller@delete');

Route::get('/main/perencanaan/penanganan/pengamanan_dampak', 'MAIN\bk010308Controller@index');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/select', 'MAIN\bk010308Controller@select');
Route::post('/main/perencanaan/penanganan/pengamanan_dampak', 'MAIN\bk010308Controller@post');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/create', 'MAIN\bk010308Controller@create');
Route::post('/main/perencanaan/penanganan/pengamanan_dampak/create', 'MAIN\bk010308Controller@post_create');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/delete', 'MAIN\bk010308Controller@delete');

Route::get('/main/perencanaan/kawasan/perencanaan', 'MAIN\bk010309Controller@index');
Route::post('/main/perencanaan/kawasan/perencanaan', 'MAIN\bk010309Controller@post');
Route::get('/main/perencanaan/kawasan/perencanaan/create', 'MAIN\bk010309Controller@create');
Route::post('/main/perencanaan/kawasan/perencanaan/create', 'MAIN\bk010309Controller@post_create');
Route::get('/main/perencanaan/kawasan/perencanaan/delete', 'MAIN\bk010309Controller@delete');
Route::get('/main/perencanaan/kawasan/perencanaan/select', 'MAIN\bk010309Controller@select');

Route::get('/main/perencanaan/kawasan/investasi', 'MAIN\bk010310Controller@index');
Route::post('/main/perencanaan/kawasan/investasi', 'MAIN\bk010310Controller@post');
Route::get('/main/perencanaan/kawasan/investasi/create', 'MAIN\bk010310Controller@create');
Route::post('/main/perencanaan/kawasan/investasi/create', 'MAIN\bk010310Controller@post_create');
Route::get('/main/perencanaan/kawasan/investasi/delete', 'MAIN\bk010310Controller@delete');
Route::get('/main/perencanaan/kawasan/investasi/select', 'MAIN\bk010310Controller@select');

Route::get('/main/perencanaan/rencana_kegiatan', 'MAIN\bk010311Controller@index');
Route::post('/main/perencanaan/rencana_kegiatan', 'MAIN\bk010311Controller@post');
Route::get('/main/perencanaan/rencana_kegiatan/create', 'MAIN\bk010311Controller@create');
Route::post('/main/perencanaan/rencana_kegiatan/create', 'MAIN\bk010311Controller@post_create');
Route::get('/main/perencanaan/rencana_kegiatan/delete', 'MAIN\bk010311Controller@delete');
Route::get('/main/perencanaan/rencana_kegiatan/select', 'MAIN\bk010311Controller@select');

Route::get('/main/perencanaan/infra/penyiapan_paket', 'MAIN\bk010312Controller@index');
Route::post('/main/perencanaan/infra/penyiapan_paket', 'MAIN\bk010312Controller@post');
Route::get('/main/perencanaan/infra/penyiapan_paket/create', 'MAIN\bk010312Controller@create');
Route::post('/main/perencanaan/infra/penyiapan_paket/create', 'MAIN\bk010312Controller@post_create');
Route::get('/main/perencanaan/infra/penyiapan_paket/delete', 'MAIN\bk010312Controller@delete');
Route::get('/main/perencanaan/infra/penyiapan_paket/select', 'MAIN\bk010312Controller@select');

Route::get('/main/perencanaan/infra/amdal', 'MAIN\bk010313Controller@index');
Route::post('/main/perencanaan/infra/amdal', 'MAIN\bk010313Controller@post');
Route::get('/main/perencanaan/infra/amdal/create', 'MAIN\bk010313Controller@create');
Route::post('/main/perencanaan/infra/amdal/create', 'MAIN\bk010313Controller@post_create');
Route::get('/main/perencanaan/infra/amdal/delete', 'MAIN\bk010313Controller@delete');
Route::get('/main/perencanaan/infra/amdal/select', 'MAIN\bk010313Controller@select');

Route::get('/main/perencanaan/pengadaan_lelang', 'MAIN\bk010314Controller@index');
Route::post('/main/perencanaan/pengadaan_lelang', 'MAIN\bk010314Controller@post');
Route::get('/main/perencanaan/pengadaan_lelang/create', 'MAIN\bk010314Controller@create');
Route::post('/main/perencanaan/pengadaan_lelang/create', 'MAIN\bk010314Controller@post_create');
Route::get('/main/perencanaan/pengadaan_lelang/delete', 'MAIN\bk010314Controller@delete');
Route::get('/main/perencanaan/pengadaan_lelang/select', 'MAIN\bk010314Controller@select');

Route::post('/main/perencanaan/pengadaan_lelang/peserta', 'MAIN\bk010314Controller@post_peserta');
Route::get('/main/perencanaan/pengadaan_lelang/peserta/create', 'MAIN\bk010314Controller@create_peserta');
Route::post('/main/perencanaan/pengadaan_lelang/peserta/create', 'MAIN\bk010314Controller@post_peserta_create');
Route::get('/main/perencanaan/pengadaan_lelang/peserta/delete', 'MAIN\bk010314Controller@delete_peserta');

Route::get('/main/perencanaan/kontrak_paket', 'MAIN\bk010315Controller@index');
Route::post('/main/perencanaan/kontrak_paket', 'MAIN\bk010315Controller@post');
Route::get('/main/perencanaan/kontrak_paket/create', 'MAIN\bk010315Controller@create');
Route::post('/main/perencanaan/kontrak_paket/create', 'MAIN\bk010315Controller@post_create');
Route::get('/main/perencanaan/kontrak_paket/delete', 'MAIN\bk010315Controller@delete');
Route::get('/main/perencanaan/kontrak_paket/select', 'MAIN\bk010315Controller@select');
Route::get('/main/perencanaan/kontrak_paket/select', 'MAIN\bk010315Controller@select');

Route::get('/main/perencanaan/kelurahan/penanganan_kumuh', 'MAIN\bk010316Controller@index');
Route::get('/main/perencanaan/kelurahan/penanganan_kumuh/select', 'MAIN\bk010316Controller@select');
Route::post('/main/perencanaan/kelurahan/penanganan_kumuh', 'MAIN\bk010316Controller@post');
Route::get('/main/perencanaan/kelurahan/penanganan_kumuh/create', 'MAIN\bk010316Controller@create');
Route::post('/main/perencanaan/kelurahan/penanganan_kumuh/create', 'MAIN\bk010316Controller@post_create');
Route::get('/main/perencanaan/kelurahan/penanganan_kumuh/delete', 'MAIN\bk010316Controller@delete');

Route::get('/main/perencanaan/kelurahan/penyusunan_rplp', 'MAIN\bk010317Controller@index');
Route::get('/main/perencanaan/kelurahan/penyusunan_rplp/select', 'MAIN\bk010317Controller@select');
Route::post('/main/perencanaan/kelurahan/penyusunan_rplp', 'MAIN\bk010317Controller@post');
Route::get('/main/perencanaan/kelurahan/penyusunan_rplp/create', 'MAIN\bk010317Controller@create');
Route::post('/main/perencanaan/kelurahan/penyusunan_rplp/create', 'MAIN\bk010317Controller@post_create');
Route::get('/main/perencanaan/kelurahan/penyusunan_rplp/delete', 'MAIN\bk010317Controller@delete');

Route::get('/main/perencanaan/kelurahan/investasi_5thn', 'MAIN\bk010318Controller@index');
Route::get('/main/perencanaan/kelurahan/investasi_5thn/select', 'MAIN\bk010318Controller@select');
Route::post('/main/perencanaan/kelurahan/investasi_5thn', 'MAIN\bk010318Controller@post');
Route::get('/main/perencanaan/kelurahan/investasi_5thn/create', 'MAIN\bk010318Controller@create');
Route::post('/main/perencanaan/kelurahan/investasi_5thn/create', 'MAIN\bk010318Controller@post_create');
Route::get('/main/perencanaan/kelurahan/investasi_5thn/delete', 'MAIN\bk010318Controller@delete');

Route::get('/main/perencanaan/kelurahan/kegiatan', 'MAIN\bk010319Controller@index');
Route::get('/main/perencanaan/kelurahan/kegiatan/select', 'MAIN\bk010319Controller@select');
Route::post('/main/perencanaan/kelurahan/kegiatan', 'MAIN\bk010319Controller@post');
Route::get('/main/perencanaan/kelurahan/kegiatan/create', 'MAIN\bk010319Controller@create');
Route::post('/main/perencanaan/kelurahan/kegiatan/create', 'MAIN\bk010319Controller@post_create');
Route::get('/main/perencanaan/kelurahan/kegiatan/delete', 'MAIN\bk010319Controller@delete');

//pelaksanaan
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kegiatan', 'MAIN\bk010401Controller@index');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kegiatan/select', 'MAIN\bk010401Controller@select');
Route::post('/main/pelaksanaan/kota_bdi/realisasi_kegiatan', 'MAIN\bk010401Controller@post');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kegiatan/create', 'MAIN\bk010401Controller@create');
Route::post('/main/pelaksanaan/kota_bdi/realisasi_kegiatan/create', 'MAIN\bk010401Controller@post_create');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kegiatan/delete', 'MAIN\bk010401Controller@delete');
Route::post('/main/pelaksanaan/kota_bdi/realisasi_kegiatan/pemanfaat', 'MAIN\bk010401Controller@post_pemanfaat');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kegiatan/pemanfaat/create', 'MAIN\bk010401Controller@pemanfaat_create');
Route::post('/main/pelaksanaan/kota_bdi/realisasi_kegiatan/pemanfaat/create', 'MAIN\bk010401Controller@post_pemanfaat_create');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kegiatan/pemanfaat/delete', 'MAIN\bk010401Controller@delete_pemanfaat');

Route::get('/main/pelaksanaan/kota_bdi/pencairan_kontraktor', 'MAIN\bk010402Controller@index');
Route::get('/main/pelaksanaan/kota_bdi/pencairan_kontraktor/select', 'MAIN\bk010402Controller@select');
Route::post('/main/pelaksanaan/kota_bdi/pencairan_kontraktor', 'MAIN\bk010402Controller@post');
Route::get('/main/pelaksanaan/kota_bdi/pencairan_kontraktor/create', 'MAIN\bk010402Controller@create');
Route::post('/main/pelaksanaan/kota_bdi/pencairan_kontraktor/create', 'MAIN\bk010402Controller@post_create');
Route::get('/main/pelaksanaan/kota_bdi/pencairan_kontraktor/delete', 'MAIN\bk010402Controller@delete');

Route::get('/main/pelaksanaan/kota_bdi/realisasi_kontrak', 'MAIN\bk010403Controller@index');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kontrak/select', 'MAIN\bk010403Controller@select');
Route::post('/main/pelaksanaan/kota_bdi/realisasi_kontrak', 'MAIN\bk010403Controller@post');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kontrak/create', 'MAIN\bk010403Controller@create');
Route::post('/main/pelaksanaan/kota_bdi/realisasi_kontrak/create', 'MAIN\bk010403Controller@post_create');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kontrak/delete', 'MAIN\bk010403Controller@delete');
Route::post('/main/pelaksanaan/kota_bdi/realisasi_kontrak/pemanfaat', 'MAIN\bk010403Controller@post_pemanfaat');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kontrak/pemanfaat/create', 'MAIN\bk010403Controller@pemanfaat_create');
Route::post('/main/pelaksanaan/kota_bdi/realisasi_kontrak/pemanfaat/create', 'MAIN\bk010403Controller@post_pemanfaat_create');
Route::get('/main/pelaksanaan/kota_bdi/realisasi_kontrak/pemanfaat/delete', 'MAIN\bk010403Controller@delete_pemanfaat');

Route::get('/main/pelaksanaan/kota_bdi/sertifikasi_infra', 'MAIN\bk010404Controller@index');
Route::get('/main/pelaksanaan/kota_bdi/sertifikasi_infra/select', 'MAIN\bk010404Controller@select');
Route::post('/main/pelaksanaan/kota_bdi/sertifikasi_infra', 'MAIN\bk010404Controller@post');
Route::get('/main/pelaksanaan/kota_bdi/sertifikasi_infra/create', 'MAIN\bk010404Controller@create');
Route::post('/main/pelaksanaan/kota_bdi/sertifikasi_infra/create', 'MAIN\bk010404Controller@post_create');
Route::get('/main/pelaksanaan/kota_bdi/sertifikasi_infra/delete', 'MAIN\bk010404Controller@delete');

Route::get('/main/pelaksanaan/kota_non/realisasi_kegiatan', 'MAIN\bk010405Controller@index');
Route::get('/main/pelaksanaan/kota_non/realisasi_kegiatan/select', 'MAIN\bk010405Controller@select');
Route::post('/main/pelaksanaan/kota_non/realisasi_kegiatan', 'MAIN\bk010405Controller@post');
Route::get('/main/pelaksanaan/kota_non/realisasi_kegiatan/create', 'MAIN\bk010405Controller@create');
Route::post('/main/pelaksanaan/kota_non/realisasi_kegiatan/create', 'MAIN\bk010405Controller@post_create');
Route::get('/main/pelaksanaan/kota_non/realisasi_kegiatan/delete', 'MAIN\bk010405Controller@delete');
Route::post('/main/pelaksanaan/kota_non/realisasi_kegiatan/pemanfaat', 'MAIN\bk010405Controller@post_pemanfaat');
Route::get('/main/pelaksanaan/kota_non/realisasi_kegiatan/pemanfaat/create', 'MAIN\bk010405Controller@pemanfaat_create');
Route::post('/main/pelaksanaan/kota_non/realisasi_kegiatan/pemanfaat/create', 'MAIN\bk010405Controller@post_pemanfaat_create');
Route::get('/main/pelaksanaan/kota_non/realisasi_kegiatan/pemanfaat/delete', 'MAIN\bk010405Controller@delete_pemanfaat');

Route::get('/main/pelaksanaan/kota_non/sertifikasi_infra', 'MAIN\bk010406Controller@index');
Route::get('/main/pelaksanaan/kota_non/sertifikasi_infra/select', 'MAIN\bk010406Controller@select');
Route::post('/main/pelaksanaan/kota_non/sertifikasi_infra', 'MAIN\bk010406Controller@post');
Route::get('/main/pelaksanaan/kota_non/sertifikasi_infra/create', 'MAIN\bk010406Controller@create');
Route::post('/main/pelaksanaan/kota_non/sertifikasi_infra/create', 'MAIN\bk010406Controller@post_create');
Route::get('/main/pelaksanaan/kota_non/sertifikasi_infra/delete', 'MAIN\bk010406Controller@delete');

Route::get('/main/pelaksanaan/kelurahan/pagu_pencairan', 'MAIN\bk010407Controller@index');
Route::post('/main/pelaksanaan/kelurahan/pagu_pencairan', 'MAIN\bk010407Controller@post');
Route::get('/main/pelaksanaan/kelurahan/pagu_pencairan/create', 'MAIN\bk010407Controller@create');
Route::post('/main/pelaksanaan/kelurahan/pagu_pencairan/create', 'MAIN\bk010407Controller@post_create');
Route::get('/main/pelaksanaan/kelurahan/pagu_pencairan/delete', 'MAIN\bk010407Controller@delete');
Route::get('/main/pelaksanaan/kelurahan/pagu_pencairan/select', 'MAIN\bk010407Controller@select');

Route::get('/main/pelaksanaan/kelurahan/ksm', 'MAIN\bk010408Controller@index');
Route::post('/main/pelaksanaan/kelurahan/ksm', 'MAIN\bk010408Controller@post');
Route::get('/main/pelaksanaan/kelurahan/ksm/create', 'MAIN\bk010408Controller@create');
Route::post('/main/pelaksanaan/kelurahan/ksm/create', 'MAIN\bk010408Controller@post_create');
Route::get('/main/pelaksanaan/kelurahan/ksm/delete', 'MAIN\bk010408Controller@delete');

Route::get('/main/pelaksanaan/kelurahan/sertifikasi_infra', 'MAIN\bk010409Controller@index');
Route::post('/main/pelaksanaan/kelurahan/sertifikasi_infra', 'MAIN\bk010409Controller@post');
Route::get('/main/pelaksanaan/kelurahan/sertifikasi_infra/create', 'MAIN\bk010409Controller@create');
Route::post('/main/pelaksanaan/kelurahan/sertifikasi_infra/create', 'MAIN\bk010409Controller@post_create');
Route::get('/main/pelaksanaan/kelurahan/sertifikasi_infra/delete', 'MAIN\bk010409Controller@delete');

Route::get('/main/pelaksanaan/kelurahan/realisasi_kegiatan', 'MAIN\bk010410Controller@index');
Route::post('/main/pelaksanaan/kelurahan/realisasi_kegiatan', 'MAIN\bk010410Controller@post');
Route::get('/main/pelaksanaan/kelurahan/realisasi_kegiatan/create', 'MAIN\bk010410Controller@create');
Route::post('/main/pelaksanaan/kelurahan/realisasi_kegiatan/create', 'MAIN\bk010410Controller@post_create');
Route::get('/main/pelaksanaan/kelurahan/realisasi_kegiatan/delete', 'MAIN\bk010410Controller@delete');
Route::get('/main/pelaksanaan/kelurahan/realisasi_kegiatan/select', 'MAIN\bk010410Controller@select');
Route::post('/main/pelaksanaan/kelurahan/realisasi_kegiatan/pemanfaat', 'MAIN\bk010410Controller@post_pemanfaat');
Route::get('/main/pelaksanaan/kelurahan/realisasi_kegiatan/pemanfaat/create', 'MAIN\bk010410Controller@pemanfaat_create');
Route::post('/main/pelaksanaan/kelurahan/realisasi_kegiatan/pemanfaat/create', 'MAIN\bk010410Controller@post_pemanfaat_create');
Route::get('/main/pelaksanaan/kelurahan/realisasi_kegiatan/pemanfaat/delete', 'MAIN\bk010410Controller@delete_pemanfaat');

Route::get('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan', 'MAIN\bk010411Controller@index');
Route::post('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan', 'MAIN\bk010411Controller@post');
Route::get('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan/create', 'MAIN\bk010411Controller@create');
Route::post('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan/create', 'MAIN\bk010411Controller@post_create');
Route::get('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan/delete', 'MAIN\bk010411Controller@delete');
Route::get('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan/select', 'MAIN\bk010411Controller@select');
Route::post('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan/pemanfaat', 'MAIN\bk010411Controller@post_pemanfaat');
Route::get('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan/pemanfaat/create', 'MAIN\bk010411Controller@pemanfaat_create');
Route::post('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan/pemanfaat/create', 'MAIN\bk010411Controller@post_pemanfaat_create');
Route::get('/main/pelaksanaan/kelurahan_non/realisasi_kegiatan/pemanfaat/delete', 'MAIN\bk010411Controller@delete_pemanfaat');

Route::get('/main/pelaksanaan/kelurahan_non/sertifikasi_infra', 'MAIN\bk010412Controller@index');
Route::post('/main/pelaksanaan/kelurahan_non/sertifikasi_infra', 'MAIN\bk010412Controller@post');
Route::get('/main/pelaksanaan/kelurahan_non/sertifikasi_infra/create', 'MAIN\bk010412Controller@create');
Route::post('/main/pelaksanaan/kelurahan_non/sertifikasi_infra/create', 'MAIN\bk010412Controller@post_create');
Route::get('/main/pelaksanaan/kelurahan_non/sertifikasi_infra/delete', 'MAIN\bk010412Controller@delete');

Route::get('/main/keberlanjutan/kota/serah_terima', 'MAIN\bk010501Controller@index');
Route::get('/main/keberlanjutan/kota/serah_terima/select', 'MAIN\bk010501Controller@select');
Route::post('/main/keberlanjutan/kota/serah_terima', 'MAIN\bk010501Controller@post');
Route::get('/main/keberlanjutan/kota/serah_terima/create', 'MAIN\bk010501Controller@create');
Route::post('/main/keberlanjutan/kota/serah_terima/create', 'MAIN\bk010501Controller@post_create');
Route::get('/main/keberlanjutan/kota/serah_terima/delete', 'MAIN\bk010501Controller@delete');

Route::get('/main/keberlanjutan/kota/operasional', 'MAIN\bk010502Controller@index');
Route::post('/main/keberlanjutan/kota/operasional', 'MAIN\bk010502Controller@post');
Route::get('/main/keberlanjutan/kota/operasional/create', 'MAIN\bk010502Controller@create');
Route::post('/main/keberlanjutan/kota/operasional/create', 'MAIN\bk010502Controller@post_create');
Route::get('/main/keberlanjutan/kota/operasional/delete', 'MAIN\bk010502Controller@delete');

Route::get('/main/keberlanjutan/kelurahan/status_kemandirian', 'MAIN\bk010503Controller@index');
Route::post('/main/keberlanjutan/kelurahan/status_kemandirian', 'MAIN\bk010503Controller@post');
Route::get('/main/keberlanjutan/kelurahan/status_kemandirian/create', 'MAIN\bk010503Controller@create');
Route::post('/main/keberlanjutan/kelurahan/status_kemandirian/create', 'MAIN\bk010503Controller@post_create');
Route::get('/main/keberlanjutan/kelurahan/status_kemandirian/delete', 'MAIN\bk010503Controller@delete');

Route::get('/main/keberlanjutan/kelurahan/pemeliharaan', 'MAIN\bk010504Controller@index');
Route::post('/main/keberlanjutan/kelurahan/pemeliharaan', 'MAIN\bk010504Controller@post');
Route::get('/main/keberlanjutan/kelurahan/pemeliharaan/create', 'MAIN\bk010504Controller@create');
Route::post('/main/keberlanjutan/kelurahan/pemeliharaan/create', 'MAIN\bk010504Controller@post_create');
Route::get('/main/keberlanjutan/kelurahan/pemeliharaan/delete', 'MAIN\bk010504Controller@delete');

Route::get('/main/keberlanjutan/kelurahan/audit', 'MAIN\bk010505Controller@index');
Route::get('/main/keberlanjutan/kelurahan/audit/select', 'MAIN\bk010505Controller@select');
Route::post('/main/keberlanjutan/kelurahan/audit', 'MAIN\bk010505Controller@post');
Route::get('/main/keberlanjutan/kelurahan/audit/create', 'MAIN\bk010505Controller@create');
Route::post('/main/keberlanjutan/kelurahan/audit/create', 'MAIN\bk010505Controller@post_create');
Route::get('/main/keberlanjutan/kelurahan/audit/delete', 'MAIN\bk010505Controller@delete');

/**
 *
 *
 *module GIS route here
 */
Route::get('/gis', 'GIS\bk040101Controller@index');
Route::get('/gis/map-kota', 'GIS\bk040101Controller@kota');
Route::get('/gis/map-kecamatan', 'GIS\bk040101Controller@kecamatan');

/**
 *
 *
 *module QS route here
 */
Route::get('/qs', 'HomeController@qs');

//master data
Route::get('/qs/master/agenda', 'QS\bk050101Controller@index');
Route::post('/qs/master/agenda', 'QS\bk050101Controller@post');
Route::get('/qs/master/agenda/create', 'QS\bk050101Controller@create');
Route::post('/qs/master/agenda/create', 'QS\bk050101Controller@post_create');
Route::get('/qs/master/agenda/delete', 'QS\bk050101Controller@delete');

Route::get('/qs/master/kegiatan_kelurahan', 'QS\bk050102Controller@index');
Route::post('/qs/master/kegiatan_kelurahan', 'QS\bk050102Controller@post');
Route::get('/qs/master/kegiatan_kelurahan/create', 'QS\bk050102Controller@create');
Route::post('/qs/master/kegiatan_kelurahan/create', 'QS\bk050102Controller@post_create');
Route::get('/qs/master/kegiatan_kelurahan/delete', 'QS\bk050102Controller@delete');

Route::get('/qs/master/kegiatan_kota', 'QS\bk050103Controller@index');
Route::post('/qs/master/kegiatan_kota', 'QS\bk050103Controller@post');
Route::get('/qs/master/kegiatan_kota/create', 'QS\bk050103Controller@create');
Route::post('/qs/master/kegiatan_kota/create', 'QS\bk050103Controller@post_create');
Route::get('/qs/master/kegiatan_kota/delete', 'QS\bk050103Controller@delete');

Route::get('/qs/master/schedule', 'QS\bk050104Controller@index');
Route::post('/qs/master/schedule', 'QS\bk050104Controller@post');
Route::get('/qs/master/schedule/create', 'QS\bk050104Controller@create');
Route::post('/qs/master/schedule/create', 'QS\bk050104Controller@post_create');
Route::get('/qs/master/schedule/delete', 'QS\bk050104Controller@delete');

Route::get('/qs/monitoring/kelurahan', 'QS\bk050201Controller@index');
Route::post('/qs/monitoring/kelurahan/prov', 'QS\bk050201Controller@post_prov');
Route::get('/qs/monitoring/kelurahan/kota', 'QS\bk050201Controller@kota');
Route::post('/qs/monitoring/kelurahan/kota', 'QS\bk050201Controller@post_kota');
Route::get('/qs/monitoring/kelurahan/kelurahan', 'QS\bk050201Controller@kelurahan');
Route::post('/qs/monitoring/kelurahan/kelurahan', 'QS\bk050201Controller@post_kelurahan');
Route::get('/qs/monitoring/kelurahan/kelurahan/peningkatan', 'QS\bk050201Controller@peningkatan');
Route::get('/qs/monitoring/kelurahan/kota/peningkatan', 'QS\bk050201Controller@peningkatan_kota');
Route::get('/qs/monitoring/kelurahan/prov/peningkatan', 'QS\bk050201Controller@peningkatan_prov');
Route::get('/qs/monitoring/kelurahan/kelurahan/pencegahan', 'QS\bk050201Controller@pencegahan');
Route::get('/qs/monitoring/kelurahan/kota/pencegahan', 'QS\bk050201Controller@pencegahan_kota');
Route::get('/qs/monitoring/kelurahan/prov/pencegahan', 'QS\bk050201Controller@pencegahan_prov');
Route::get('/qs/monitoring/kelurahan/kelurahan/ppmk', 'QS\bk050201Controller@ppmk');
Route::get('/qs/monitoring/kelurahan/kota/ppmk', 'QS\bk050201Controller@ppmk_kota');
Route::get('/qs/monitoring/kelurahan/prov/ppmk', 'QS\bk050201Controller@ppmk_prov');
Route::get('/qs/monitoring/kelurahan/kelurahan/bdi', 'QS\bk050201Controller@bdi');
Route::get('/qs/monitoring/kelurahan/kota/bdi', 'QS\bk050201Controller@bdi_kota');
Route::get('/qs/monitoring/kelurahan/prov/bdi', 'QS\bk050201Controller@bdi_prov');
Auth::routes();
