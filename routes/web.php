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

//management
Route::get('/hrm/admin/role', 'HRM\bk020102Controller@index');
Route::post('hrm/admin/role', 'HRM\bk020102Controller@post');
Route::get('/hrm/admin/role/create', 'HRM\bk020102Controller@create');
Route::post('/hrm/admin/role/create', 'HRM\bk020102Controller@post_create');
Route::get('/hrm/admin/role/delete', 'HRM\bk020102Controller@delete');

Route::get('/hrm/admin/role_level', 'HRM\bk020101Controller@index');
Route::post('hrm/admin/role_level', 'HRM\bk020101Controller@post');
Route::get('/hrm/admin/role_level/create', 'HRM\bk020101Controller@create');
Route::post('/hrm/admin/role_level/create', 'HRM\bk020101Controller@post_create');
Route::get('/hrm/admin/role_level/delete', 'HRM\bk020101Controller@delete');

Route::get('/hrm/admin/manajemen_role', 'HRM\bk020109Controller@index');
Route::get('/hrm/admin/manajemen_role/show', 'HRM\bk020109Controller@show');
Route::post('/hrm/admin/manajemen_role', 'HRM\bk020109Controller@post');

Route::get('/hrm/admin/manajemen_user', 'HRM\bk020111Controller@index');
Route::get('/hrm/admin/manajemen_user/select', 'HRM\bk020111Controller@select');
Route::post('hrm/admin/manajemen_user', 'HRM\bk020111Controller@post');
Route::get('/hrm/admin/manajemen_user/create', 'HRM\bk020111Controller@create');
Route::post('/hrm/admin/manajemen_user/create', 'HRM\bk020111Controller@post_create');
Route::get('/hrm/admin/manajemen_user/delete', 'HRM\bk020111Controller@delete');

Route::get('/hrm/admin/activity_log', 'HRM\bk020201Controller@index');
Route::post('hrm/admin/activity_log', 'HRM\bk020201Controller@post');

Route::get('/hrm/management_diri/aktivasi', 'HRM\bk020302Controller@index');
Route::post('/hrm/management_diri/aktivasi', 'HRM\bk020302Controller@post');

Route::get('/hrm/profil/user', 'HRM\bk020312Controller@index');
Route::post('/hrm/profil/user', 'HRM\bk020312Controller@post');

Route::get('/hrm/profil/pesan', 'HRM\bk020301Controller@index');
Route::post('/hrm/profil/pesan', 'HRM\bk020301Controller@post');
Route::get('/hrm/profil/pesan/baca', 'HRM\bk020301Controller@baca');
Route::get('/hrm/profil/pesan/delete', 'HRM\bk020301Controller@delete');

Route::get('/hrm/profil/pelatihan', 'HRM\bk020303Controller@index');
Route::post('hrm/profil/pelatihan', 'HRM\bk020303Controller@post');
Route::get('/hrm/profil/pelatihan/create', 'HRM\bk020303Controller@create');
Route::post('/hrm/profil/pelatihan/create', 'HRM\bk020303Controller@post_create');
Route::get('/hrm/profil/pelatihan/delete', 'HRM\bk020303Controller@delete');

Route::get('/hrm/profil/pendidikan', 'HRM\bk020304Controller@index');
Route::post('hrm/profil/pendidikan', 'HRM\bk020304Controller@post');
Route::get('/hrm/profil/pendidikan/create', 'HRM\bk020304Controller@create');
Route::post('/hrm/profil/pendidikan/create', 'HRM\bk020304Controller@post_create');
Route::get('/hrm/profil/pendidikan/delete', 'HRM\bk020304Controller@delete');

Route::get('/hrm/profil/penghargaan', 'HRM\bk020305Controller@index');
Route::post('hrm/profil/penghargaan', 'HRM\bk020305Controller@post');
Route::get('/hrm/profil/penghargaan/create', 'HRM\bk020305Controller@create');
Route::post('/hrm/profil/penghargaan/create', 'HRM\bk020305Controller@post_create');
Route::get('/hrm/profil/penghargaan/delete', 'HRM\bk020305Controller@delete');

Route::get('/hrm/profil/user/perubahan', 'HRM\bk020306Controller@index');
Route::post('hrm/profil/user/perubahan', 'HRM\bk020306Controller@post');
Route::get('/hrm/profil/user/perubahan/create', 'HRM\bk020306Controller@create');
Route::post('/hrm/profil/user/perubahan/create', 'HRM\bk020306Controller@post_create');
Route::get('/hrm/profil/user/perubahan/delete', 'HRM\bk020306Controller@delete');
Route::post('/hrm/profil/user/perubahan/approve', 'HRM\bk020306Controller@approve');
Route::post('/hrm/profil/user/perubahan/reject', 'HRM\bk020306Controller@reject');

Route::get('/hrm/profil/password', 'HRM\bk020307Controller@index');
Route::post('hrm/profil/password', 'HRM\bk020307Controller@post');

Route::get('/hrm/management_personil/persetujuan/pendaftaran', 'HRM\bk020316Controller@index');
Route::post('hrm/management_personil/persetujuan/pendaftaran', 'HRM\bk020316Controller@post');
Route::get('/hrm/management_personil/persetujuan/pendaftaran/create', 'HRM\bk020316Controller@create');
Route::post('/hrm/management_personil/persetujuan/pendaftaran/create', 'HRM\bk020316Controller@post_create');
Route::post('/hrm/management_personil/persetujuan/pendaftaran/tolak', 'HRM\bk020316Controller@post_tolak');
Route::get('/hrm/management_personil/persetujuan/pendaftaran/delete', 'HRM\bk020316Controller@delete');

Route::get('/hrm/management_personil/persetujuan/mutasi', 'HRM\bk020317Controller@index');
Route::post('hrm/management_personil/persetujuan/mutasi', 'HRM\bk020317Controller@post');
Route::get('/hrm/management_personil/persetujuan/mutasi/create', 'HRM\bk020317Controller@create');
Route::post('/hrm/management_personil/persetujuan/mutasi/approve', 'HRM\bk020317Controller@approve');
Route::post('/hrm/management_personil/persetujuan/mutasi/reject', 'HRM\bk020317Controller@reject');

Route::get('/hrm/management_personil/persetujuan/demosi', 'HRM\bk020318Controller@index');
Route::post('hrm/management_personil/persetujuan/demosi', 'HRM\bk020318Controller@post');
Route::get('/hrm/management_personil/persetujuan/demosi/create', 'HRM\bk020318Controller@create');
Route::post('/hrm/management_personil/persetujuan/demosi/approve', 'HRM\bk020318Controller@approve');
Route::post('/hrm/management_personil/persetujuan/demosi/reject', 'HRM\bk020318Controller@reject');

Route::get('/hrm/management_personil/persetujuan/promosi', 'HRM\bk020319Controller@index');
Route::post('hrm/management_personil/persetujuan/promosi', 'HRM\bk020319Controller@post');
Route::get('/hrm/management_personil/persetujuan/promosi/create', 'HRM\bk020319Controller@create');
Route::post('/hrm/management_personil/persetujuan/promosi/approve', 'HRM\bk020398Controller@approve');
Route::post('/hrm/management_personil/persetujuan/promosi/reject', 'HRM\bk020319Controller@reject');

Route::get('/hrm/management_personil/persetujuan/evaluasi', 'HRM\bk020320Controller@index');
Route::post('hrm/management_personil/persetujuan/evaluasi', 'HRM\bk020320Controller@post');
Route::get('/hrm/management_personil/persetujuan/evaluasi/create', 'HRM\bk020320Controller@create');
Route::post('/hrm/management_personil/persetujuan/evaluasi/create', 'HRM\bk020320Controller@post_create');
Route::get('/hrm/management_personil/persetujuan/evaluasi/delete', 'HRM\bk020320Controller@delete');

Route::get('/hrm/management_personil/mutasi', 'HRM\bk020321Controller@index');
Route::post('hrm/management_personil/mutasi', 'HRM\bk020321Controller@post');
Route::get('/hrm/management_personil/mutasi/create', 'HRM\bk020321Controller@create');
Route::post('/hrm/management_personil/mutasi/create', 'HRM\bk020321Controller@post_create');
Route::get('/hrm/management_personil/mutasi/delete', 'HRM\bk020321Controller@delete');
Route::post('/hrm/management_personil/mutasi/approve', 'HRM\bk020321Controller@approve');
Route::post('/hrm/management_personil/mutasi/reject', 'HRM\bk020321Controller@reject');

Route::get('/hrm/management_personil/demosi', 'HRM\bk020322Controller@index');
Route::post('hrm/management_personil/demosi', 'HRM\bk020322Controller@post');
Route::get('/hrm/management_personil/demosi/create', 'HRM\bk020322Controller@create');
Route::post('/hrm/management_personil/demosi/create', 'HRM\bk020322Controller@post_create');
Route::get('/hrm/management_personil/demosi/delete', 'HRM\bk020322Controller@delete');
Route::post('/hrm/management_personil/demosi/approve', 'HRM\bk020322Controller@approve');
Route::post('/hrm/management_personil/demosi/reject', 'HRM\bk020322Controller@reject');

Route::get('/hrm/management_personil/promosi', 'HRM\bk020323Controller@index');
Route::post('hrm/management_personil/promosi', 'HRM\bk020323Controller@post');
Route::get('/hrm/management_personil/promosi/create', 'HRM\bk020323Controller@create');
Route::post('/hrm/management_personil/promosi/create', 'HRM\bk020323Controller@post_create');
Route::get('/hrm/management_personil/promosi/delete', 'HRM\bk020323Controller@delete');
Route::post('/hrm/management_personil/promosi/approve', 'HRM\bk020323Controller@approve');
Route::post('/hrm/management_personil/promosi/reject', 'HRM\bk020323Controller@reject');

Route::get('/hrm/management_personil/blacklist', 'HRM\bk020308Controller@index');
Route::post('/hrm/management_personil/blacklist', 'HRM\bk020308Controller@post');
Route::get('/hrm/management_personil/blacklist/create', 'HRM\bk020308Controller@create');
Route::post('/hrm/management_personil/blacklist/create', 'HRM\bk020308Controller@post_create');

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

Route::get('/hrm/management_personil/peringatan', 'HRM\bk020313Controller@index');
Route::post('hrm/management_personil/peringatan', 'HRM\bk020313Controller@post');
Route::get('/hrm/management_personil/peringatan/create', 'HRM\bk020313Controller@create');
Route::post('/hrm/management_personil/peringatan/create', 'HRM\bk020313Controller@post_create');
Route::get('/hrm/management_personil/peringatan/delete', 'HRM\bk020313Controller@delete');

Route::get('/hrm/management_diri/mutasi', 'HRM\bk020202Controller@index');
Route::post('hrm/management_diri/mutasi', 'HRM\bk020202Controller@post');
Route::get('/hrm/management_diri/mutasi/create', 'HRM\bk020202Controller@create');
Route::post('/hrm/management_diri/mutasi/create', 'HRM\bk020202Controller@post_create');
Route::get('/hrm/management_diri/mutasi/delete', 'HRM\bk020202Controller@delete');

Route::get('/hrm/management_diri/demosi', 'HRM\bk020203Controller@index');
Route::post('hrm/management_diri/demosi', 'HRM\bk020203Controller@post');
Route::get('/hrm/management_diri/demosi/create', 'HRM\bk020203Controller@create');
Route::post('/hrm/management_diri/demosi/create', 'HRM\bk020203Controller@post_create');
Route::get('/hrm/management_diri/demosi/delete', 'HRM\bk020203Controller@delete');

Route::get('/hrm/management_diri/promosi', 'HRM\bk020204Controller@index');
Route::post('hrm/management_diri/promosi', 'HRM\bk020204Controller@post');
Route::get('/hrm/management_diri/promosi/create', 'HRM\bk020204Controller@create');
Route::post('/hrm/management_diri/promosi/create', 'HRM\bk020204Controller@post_create');
Route::get('/hrm/management_diri/promosi/delete', 'HRM\bk020204Controller@delete');

Route::get('/hrm/management_diri/evaluasi', 'HRM\bk020314Controller@index');
Route::post('hrm/management_diri/evaluasi', 'HRM\bk020314Controller@post');
Route::get('/hrm/management_diri/evaluasi/create', 'HRM\bk020314Controller@create');
Route::post('/hrm/management_diri/evaluasi/create', 'HRM\bk020314Controller@post_create');
Route::get('/hrm/management_diri/evaluasi/delete', 'HRM\bk020314Controller@delete');

Route::get('/hrm/management_personil/sidang', 'HRM\bk020315Controller@index');
Route::post('hrm/management_personil/sidang', 'HRM\bk020315Controller@post');
Route::get('/hrm/management_personil/sidang/create', 'HRM\bk020315Controller@create');
Route::post('/hrm/management_personil/sidang/create', 'HRM\bk020315Controller@post_create');
Route::get('/hrm/management_personil/sidang/delete', 'HRM\bk020315Controller@delete');

Route::get('/hrm/report/realisasi_kuota_personil/kmp', 'HRM\bk020401Controller@index');
Route::post('hrm/report/realisasi_kuota_personil/kmp', 'HRM\bk020401Controller@post');

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
Route::get('/main/persiapan/nasional/pokja/pembentukan/show', 'MAIN\bk010201Controller@show');
Route::post('/main/persiapan/nasional/pokja/pembentukan/create', 'MAIN\bk010201Controller@post_create');
Route::get('/main/persiapan/nasional/pokja/pembentukan/delete', 'MAIN\bk010201Controller@delete');

Route::get('/main/persiapan/nasional/pokja/kegiatan', 'MAIN\bk010202Controller@index');
Route::post('/main/persiapan/nasional/pokja/kegiatan', 'MAIN\bk010202Controller@post');
Route::get('/main/persiapan/nasional/pokja/kegiatan/create', 'MAIN\bk010202Controller@create');
Route::get('/main/persiapan/nasional/pokja/kegiatan/show', 'MAIN\bk010202Controller@show');
Route::post('/main/persiapan/nasional/pokja/kegiatan/create', 'MAIN\bk010202Controller@post_create');
Route::get('/main/persiapan/nasional/pokja/kegiatan/delete', 'MAIN\bk010202Controller@delete');

//propinsi
Route::get('/main/persiapan/propinsi/pokja/pembentukan', 'MAIN\bk010203Controller@index');
Route::get('/main/persiapan/propinsi/pokja/pembentukan/select', 'MAIN\bk010203Controller@select');
Route::post('/main/persiapan/propinsi/pokja/pembentukan', 'MAIN\bk010203Controller@post');
Route::get('/main/persiapan/propinsi/pokja/pembentukan/create', 'MAIN\bk010203Controller@create');
Route::get('/main/persiapan/propinsi/pokja/pembentukan/show', 'MAIN\bk010203Controller@show');
Route::post('/main/persiapan/propinsi/pokja/pembentukan/create', 'MAIN\bk010203Controller@post_create');
Route::get('/main/persiapan/propinsi/pokja/pembentukan/delete', 'MAIN\bk010203Controller@delete');

Route::get('/main/persiapan/propinsi/pokja/kegiatan', 'MAIN\bk010204Controller@index');
Route::post('/main/persiapan/propinsi/pokja/kegiatan', 'MAIN\bk010204Controller@post');
Route::get('/main/persiapan/propinsi/pokja/kegiatan/create', 'MAIN\bk010204Controller@create');
Route::get('/main/persiapan/propinsi/pokja/kegiatan/show', 'MAIN\bk010204Controller@show');
Route::post('/main/persiapan/propinsi/pokja/kegiatan/create', 'MAIN\bk010204Controller@post_create');
Route::get('/main/persiapan/propinsi/pokja/kegiatan/delete', 'MAIN\bk010204Controller@delete');

Route::get('/main/persiapan/propinsi/sosialisasi', 'MAIN\bk010236Controller@index');
Route::get('/main/persiapan/propinsi/sosialisasi/select', 'MAIN\bk010236Controller@select');
Route::post('/main/persiapan/propinsi/sosialisasi', 'MAIN\bk010236Controller@post');
Route::get('/main/persiapan/propinsi/sosialisasi/create', 'MAIN\bk010236Controller@create');
Route::get('/main/persiapan/propinsi/sosialisasi/show', 'MAIN\bk010236Controller@show');
Route::post('/main/persiapan/propinsi/sosialisasi/create', 'MAIN\bk010236Controller@post_create');
Route::get('/main/persiapan/propinsi/sosialisasi/delete', 'MAIN\bk010236Controller@delete');
//unsur
Route::post('/main/persiapan/propinsi/sosialisasi/unsur', 'MAIN\bk010236Controller@post_unsur');
Route::post('/main/persiapan/propinsi/sosialisasi/unsur/create', 'MAIN\bk010236Controller@post_unsur_create');
Route::get('/main/persiapan/propinsi/sosialisasi/unsur/delete', 'MAIN\bk010236Controller@unsur_delete');
//narasumber
Route::post('/main/persiapan/propinsi/sosialisasi/narsum', 'MAIN\bk010236Controller@post_narsum');
Route::post('/main/persiapan/propinsi/sosialisasi/narsum/create', 'MAIN\bk010236Controller@post_narsum_create');
Route::get('/main/persiapan/propinsi/sosialisasi/narsum/delete', 'MAIN\bk010236Controller@narsum_delete');

//kota
Route::get('/main/persiapan/kota/info', 'MAIN\bk010205Controller@index');
Route::post('/main/persiapan/kota/info', 'MAIN\bk010205Controller@post');
Route::get('/main/persiapan/kota/info/show', 'MAIN\bk010205Controller@show');
Route::get('/main/persiapan/kota/info/create', 'MAIN\bk010205Controller@create');
Route::post('/main/persiapan/kota/info/create', 'MAIN\bk010205Controller@post_create');
Route::get('/main/persiapan/kota/info/delete', 'MAIN\bk010205Controller@delete');

Route::get('/main/persiapan/kota/pokja/pembentukan', 'MAIN\bk010206Controller@index');
Route::get('/main/persiapan/kota/pokja/pembentukan/select', 'MAIN\bk010206Controller@select');
Route::post('/main/persiapan/kota/pokja/pembentukan', 'MAIN\bk010206Controller@post');
Route::get('/main/persiapan/kota/pokja/pembentukan/show', 'MAIN\bk010206Controller@show');
Route::get('/main/persiapan/kota/pokja/pembentukan/create', 'MAIN\bk010206Controller@create');
Route::post('/main/persiapan/kota/pokja/pembentukan/create', 'MAIN\bk010206Controller@post_create');
Route::get('/main/persiapan/kota/pokja/pembentukan/delete', 'MAIN\bk010206Controller@delete');

Route::get('/main/persiapan/kota/pokja/kegiatan', 'MAIN\bk010207Controller@index');
Route::post('/main/persiapan/kota/pokja/kegiatan', 'MAIN\bk010207Controller@post');
Route::get('/main/persiapan/kota/pokja/kegiatan/show', 'MAIN\bk010207Controller@show');
Route::get('/main/persiapan/kota/pokja/kegiatan/create', 'MAIN\bk010207Controller@create');
Route::post('/main/persiapan/kota/pokja/kegiatan/create', 'MAIN\bk010207Controller@post_create');
Route::get('/main/persiapan/kota/pokja/kegiatan/delete', 'MAIN\bk010207Controller@delete');

Route::get('/main/persiapan/kota/kegiatan/sosialisasi', 'MAIN\bk010208Controller@index');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/select', 'MAIN\bk010208Controller@select');
Route::post('/main/persiapan/kota/kegiatan/sosialisasi', 'MAIN\bk010208Controller@post');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/create', 'MAIN\bk010208Controller@create');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/show', 'MAIN\bk010208Controller@show');
Route::post('/main/persiapan/kota/kegiatan/sosialisasi/create', 'MAIN\bk010208Controller@post_create');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/delete', 'MAIN\bk010208Controller@delete');
//unsur
Route::post('/main/persiapan/kota/kegiatan/sosialisasi/unsur', 'MAIN\bk010208Controller@post_unsur');
Route::post('/main/persiapan/kota/kegiatan/sosialisasi/unsur/create', 'MAIN\bk010208Controller@post_unsur_create');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/unsur/delete', 'MAIN\bk010208Controller@unsur_delete');
//narasumber
Route::post('/main/persiapan/kota/kegiatan/sosialisasi/narsum', 'MAIN\bk010208Controller@post_narsum');
Route::post('/main/persiapan/kota/kegiatan/sosialisasi/narsum/create', 'MAIN\bk010208Controller@post_narsum_create');
Route::get('/main/persiapan/kota/kegiatan/sosialisasi/narsum/delete', 'MAIN\bk010208Controller@narsum_delete');

Route::get('/main/persiapan/kota/kegiatan/relawan', 'MAIN\bk010232Controller@index');
Route::get('/main/persiapan/kota/kegiatan/relawan/select', 'MAIN\bk010232Controller@select');
Route::post('/main/persiapan/kota/kegiatan/relawan', 'MAIN\bk010232Controller@post');
Route::get('/main/persiapan/kota/kegiatan/relawan/show', 'MAIN\bk010232Controller@show');
Route::get('/main/persiapan/kota/kegiatan/relawan/create', 'MAIN\bk010232Controller@create');
Route::post('/main/persiapan/kota/kegiatan/relawan/create', 'MAIN\bk010232Controller@post_create');
Route::get('/main/persiapan/kota/kegiatan/relawan/delete', 'MAIN\bk010232Controller@delete');

Route::get('/main/persiapan/kota/forum/bkm', 'MAIN\bk010209Controller@index');
Route::get('/main/persiapan/kota/forum/bkm/select', 'MAIN\bk010209Controller@select');
Route::post('/main/persiapan/kota/forum/bkm', 'MAIN\bk010209Controller@post');
Route::get('/main/persiapan/kota/forum/bkm/show', 'MAIN\bk010209Controller@show');
Route::get('/main/persiapan/kota/forum/bkm/create', 'MAIN\bk010209Controller@create');
Route::post('/main/persiapan/kota/forum/bkm/create', 'MAIN\bk010209Controller@post_create');
Route::get('/main/persiapan/kota/forum/bkm/delete', 'MAIN\bk010209Controller@delete');

Route::get('/main/persiapan/kota/forum/kolaborasi', 'MAIN\bk010210Controller@index');
Route::get('/main/persiapan/kota/forum/kolaborasi/select', 'MAIN\bk010210Controller@select');
Route::post('/main/persiapan/kota/forum/kolaborasi', 'MAIN\bk010210Controller@post');
Route::get('/main/persiapan/kota/forum/kolaborasi/show', 'MAIN\bk010210Controller@show');
Route::get('/main/persiapan/kota/forum/kolaborasi/create', 'MAIN\bk010210Controller@create');
Route::post('/main/persiapan/kota/forum/kolaborasi/create', 'MAIN\bk010210Controller@post_create');
Route::get('/main/persiapan/kota/forum/kolaborasi/delete', 'MAIN\bk010210Controller@delete');

Route::get('/main/persiapan/kota/forum/f_forum', 'MAIN\bk010211Controller@index');
Route::get('/main/persiapan/kota/forum/f_forum/show', 'MAIN\bk010211Controller@show');
Route::post('/main/persiapan/kota/forum/f_forum', 'MAIN\bk010211Controller@post');
Route::get('/main/persiapan/kota/forum/f_forum/create', 'MAIN\bk010211Controller@create');
Route::post('/main/persiapan/kota/forum/f_forum/create', 'MAIN\bk010211Controller@post_create');
Route::get('/main/persiapan/kota/forum/f_forum/delete', 'MAIN\bk010211Controller@delete');

//kecamatan
Route::get('/main/persiapan/kecamatan/bkm', 'MAIN\bk010212Controller@index');
Route::get('/main/persiapan/kecamatan/bkm/select', 'MAIN\bk010212Controller@select');
Route::post('/main/persiapan/kecamatan/bkm', 'MAIN\bk010212Controller@post');
Route::get('/main/persiapan/kecamatan/bkm/show', 'MAIN\bk010212Controller@show');
Route::get('/main/persiapan/kecamatan/bkm/create', 'MAIN\bk010212Controller@create');
Route::post('/main/persiapan/kecamatan/bkm/create', 'MAIN\bk010212Controller@post_create');
Route::get('/main/persiapan/kecamatan/bkm/delete', 'MAIN\bk010212Controller@delete');

Route::get('/main/persiapan/kecamatan/kolaborasi', 'MAIN\bk010213Controller@index');
Route::get('/main/persiapan/kecamatan/kolaborasi/select', 'MAIN\bk010213Controller@select');
Route::post('/main/persiapan/kecamatan/kolaborasi', 'MAIN\bk010213Controller@post');
Route::get('/main/persiapan/kecamatan/kolaborasi/show', 'MAIN\bk010213Controller@show');
Route::get('/main/persiapan/kecamatan/kolaborasi/create', 'MAIN\bk010213Controller@create');
Route::post('/main/persiapan/kecamatan/kolaborasi/create', 'MAIN\bk010213Controller@post_create');
Route::get('/main/persiapan/kecamatan/kolaborasi/delete', 'MAIN\bk010213Controller@delete');

Route::get('/main/persiapan/kecamatan/keberfungsian', 'MAIN\bk010214Controller@index');
Route::post('/main/persiapan/kecamatan/keberfungsian', 'MAIN\bk010214Controller@post');
Route::get('/main/persiapan/kecamatan/keberfungsian/create', 'MAIN\bk010214Controller@create');
Route::get('/main/persiapan/kecamatan/keberfungsian/show', 'MAIN\bk010214Controller@show');
Route::post('/main/persiapan/kecamatan/keberfungsian/create', 'MAIN\bk010214Controller@post_create');
Route::get('/main/persiapan/kecamatan/keberfungsian/delete', 'MAIN\bk010214Controller@delete');

//kelurahan
Route::get('/main/persiapan/kelurahan/info', 'MAIN\bk010215Controller@index');
Route::get('/main/persiapan/kelurahan/info/select', 'MAIN\bk010215Controller@select');
Route::post('/main/persiapan/kelurahan/info', 'MAIN\bk010215Controller@post');
Route::get('/main/persiapan/kelurahan/info/create', 'MAIN\bk010215Controller@create');
Route::post('/main/persiapan/kelurahan/info/create', 'MAIN\bk010215Controller@post_create');
Route::get('/main/persiapan/kelurahan/info/delete', 'MAIN\bk010215Controller@delete');
Route::get('/main/persiapan/kelurahan/info/show', 'MAIN\bk010215Controller@show');

Route::get('/main/persiapan/kelurahan/sosialisasi', 'MAIN\bk010216Controller@index');
Route::get('/main/persiapan/kelurahan/sosialisasi/select', 'MAIN\bk010216Controller@select');
Route::post('/main/persiapan/kelurahan/sosialisasi', 'MAIN\bk010216Controller@post');
Route::get('/main/persiapan/kelurahan/sosialisasi/create', 'MAIN\bk010216Controller@create');
Route::post('/main/persiapan/kelurahan/sosialisasi/create', 'MAIN\bk010216Controller@post_create');
Route::get('/main/persiapan/kelurahan/sosialisasi/delete', 'MAIN\bk010216Controller@delete');
Route::get('/main/persiapan/kelurahan/sosialisasi/show', 'MAIN\bk010216Controller@show');

Route::get('/main/persiapan/kelurahan/relawan', 'MAIN\bk010217Controller@index');
Route::get('/main/persiapan/kelurahan/relawan/select', 'MAIN\bk010217Controller@select');
Route::post('/main/persiapan/kelurahan/relawan', 'MAIN\bk010217Controller@post');
Route::get('/main/persiapan/kelurahan/relawan/create', 'MAIN\bk010217Controller@create');
Route::post('/main/persiapan/kelurahan/relawan/create', 'MAIN\bk010217Controller@post_create');
Route::get('/main/persiapan/kelurahan/relawan/delete', 'MAIN\bk010217Controller@delete');
Route::get('/main/persiapan/kelurahan/relawan/show', 'MAIN\bk010217Controller@show');

Route::get('/main/persiapan/kelurahan/agen_sosialisasi', 'MAIN\bk010218Controller@index');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/select', 'MAIN\bk010218Controller@select');
Route::post('/main/persiapan/kelurahan/agen_sosialisasi', 'MAIN\bk010218Controller@post');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/create', 'MAIN\bk010218Controller@create');
Route::post('/main/persiapan/kelurahan/agen_sosialisasi/create', 'MAIN\bk010218Controller@post_create');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/delete', 'MAIN\bk010218Controller@delete');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/show', 'MAIN\bk010218Controller@show');

Route::get('/main/persiapan/kelurahan/pelatihan', 'MAIN\bk010219Controller@index');
Route::get('/main/persiapan/kelurahan/pelatihan/select', 'MAIN\bk010219Controller@select');
Route::post('/main/persiapan/kelurahan/pelatihan', 'MAIN\bk010219Controller@post');
Route::get('/main/persiapan/kelurahan/pelatihan/create', 'MAIN\bk010219Controller@create');
Route::post('/main/persiapan/kelurahan/pelatihan/create', 'MAIN\bk010219Controller@post_create');
Route::get('/main/persiapan/kelurahan/pelatihan/delete', 'MAIN\bk010219Controller@delete');
Route::get('/main/persiapan/kelurahan/pelatihan/show', 'MAIN\bk010219Controller@show');

Route::get('/main/persiapan/kelurahan/forum/keanggotaan', 'MAIN\bk010220Controller@index');
Route::post('/main/persiapan/kelurahan/forum/keanggotaan', 'MAIN\bk010220Controller@post');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/create', 'MAIN\bk010220Controller@create');
Route::post('/main/persiapan/kelurahan/forum/keanggotaan/create', 'MAIN\bk010220Controller@post_create');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/delete', 'MAIN\bk010220Controller@delete');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/select', 'MAIN\bk010220Controller@select');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/show', 'MAIN\bk010220Controller@show');

Route::get('/main/persiapan/kelurahan/forum/keberfungsian', 'MAIN\bk010221Controller@index');
Route::post('/main/persiapan/kelurahan/forum/keberfungsian', 'MAIN\bk010221Controller@post');
Route::get('/main/persiapan/kelurahan/forum/keberfungsian/create', 'MAIN\bk010221Controller@create');
Route::post('/main/persiapan/kelurahan/forum/keberfungsian/create', 'MAIN\bk010221Controller@post_create');
Route::get('/main/persiapan/kelurahan/forum/keberfungsian/delete', 'MAIN\bk010221Controller@delete');
Route::get('/main/persiapan/kelurahan/forum/keberfungsian/show', 'MAIN\bk010221Controller@show');

Route::get('/main/persiapan/kelurahan/pemilu_bkm/pemilu', 'MAIN\bk010222Controller@index');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/pemilu', 'MAIN\bk010222Controller@post');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/pemilu/create', 'MAIN\bk010222Controller@create');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/pemilu/create', 'MAIN\bk010222Controller@post_create');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/pemilu/delete', 'MAIN\bk010222Controller@delete');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/pemilu/select', 'MAIN\bk010222Controller@select');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/pemilu/show', 'MAIN\bk010222Controller@show');

Route::get('/main/persiapan/kelurahan/lembaga', 'MAIN\bk010223Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga', 'MAIN\bk010223Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/create', 'MAIN\bk010223Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/create', 'MAIN\bk010223Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/delete', 'MAIN\bk010223Controller@delete');
Route::get('/main/persiapan/kelurahan/lembaga/select', 'MAIN\bk010223Controller@select');
Route::get('/main/persiapan/kelurahan/lembaga/show', 'MAIN\bk010223Controller@show');

Route::get('/main/persiapan/kelurahan/pemilu_bkm/persiapan', 'MAIN\bk010233Controller@index');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/persiapan', 'MAIN\bk010233Controller@post');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/persiapan/create', 'MAIN\bk010233Controller@create');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/persiapan/create', 'MAIN\bk010233Controller@post_create');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/persiapan/delete', 'MAIN\bk010233Controller@delete');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/persiapan/select', 'MAIN\bk010233Controller@select');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/persiapan/show', 'MAIN\bk010233Controller@show');

Route::get('/main/persiapan/kelurahan/pemilu_bkm/seleksi', 'MAIN\bk010234Controller@index');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/seleksi', 'MAIN\bk010234Controller@post');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/seleksi/create', 'MAIN\bk010234Controller@create');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/seleksi/create', 'MAIN\bk010234Controller@post_create');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/seleksi/delete', 'MAIN\bk010234Controller@delete');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/seleksi/select', 'MAIN\bk010234Controller@select');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/seleksi/show', 'MAIN\bk010234Controller@show');

Route::get('/main/persiapan/kelurahan/pemilu_bkm/data', 'MAIN\bk010235Controller@index');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/data', 'MAIN\bk010235Controller@post');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/data/create', 'MAIN\bk010235Controller@create');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/data/create', 'MAIN\bk010235Controller@post_create');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/data/delete', 'MAIN\bk010235Controller@delete');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/data/select', 'MAIN\bk010235Controller@select');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/data/show', 'MAIN\bk010235Controller@show');

Route::get('/main/persiapan/kelurahan/pemilu_bkm/data/anggota', 'MAIN\bk010235Controller@anggota_index');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/data/anggota', 'MAIN\bk010235Controller@anggota_post');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/data/anggota/create', 'MAIN\bk010235Controller@anggota_create');
Route::post('/main/persiapan/kelurahan/pemilu_bkm/data/anggota/create', 'MAIN\bk010235Controller@anggota_post_create');
Route::get('/main/persiapan/kelurahan/pemilu_bkm/data/anggota/delete', 'MAIN\bk010235Controller@anggota_delete');

//perencanaan
// Route::get('/main/perencanaan/penanganan/pembangunan_visi', 'MAIN\bk010301Controller@index');
// Route::get('/main/perencanaan/penanganan/pembangunan_visi/select', 'MAIN\bk010301Controller@select');
// Route::post('/main/perencanaan/penanganan/pembangunan_visi', 'MAIN\bk010301Controller@post');
// Route::get('/main/perencanaan/penanganan/pembangunan_visi/create', 'MAIN\bk010301Controller@create');
// Route::post('/main/perencanaan/penanganan/pembangunan_visi/create', 'MAIN\bk010301Controller@post_create');
// Route::get('/main/perencanaan/penanganan/pembangunan_visi/delete', 'MAIN\bk010301Controller@delete');
// Route::get('/main/perencanaan/penanganan/pembangunan_visi/show', 'MAIN\bk010301Controller@show');

// Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk', 'MAIN\bk010302Controller@index');
// Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/select', 'MAIN\bk010302Controller@select');
// Route::post('/main/perencanaan/penanganan/pelaksanaan_rpk', 'MAIN\bk010302Controller@post');
// Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/create', 'MAIN\bk010302Controller@create');
// Route::post('/main/perencanaan/penanganan/pelaksanaan_rpk/create', 'MAIN\bk010302Controller@post_create');
// Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/delete', 'MAIN\bk010302Controller@delete');
// Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/show', 'MAIN\bk010302Controller@show');

// Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan', 'MAIN\bk010303Controller@index');
// Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/select', 'MAIN\bk010303Controller@select');
// Route::post('/main/perencanaan/penanganan/lokakarya_perencanaan', 'MAIN\bk010303Controller@post');
// Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/create', 'MAIN\bk010303Controller@create');
// Route::post('/main/perencanaan/penanganan/lokakarya_perencanaan/create', 'MAIN\bk010303Controller@post_create');
// Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/delete', 'MAIN\bk010303Controller@delete');
// Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/show', 'MAIN\bk010303Controller@show');

// Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan', 'MAIN\bk010304Controller@index');
// Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/select', 'MAIN\bk010304Controller@select');
// Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/select', 'MAIN\bk010304Controller@select');
// Route::post('/main/perencanaan/penanganan/konsultasi_perencanaan', 'MAIN\bk010304Controller@post');
// Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/create', 'MAIN\bk010304Controller@create');
// Route::post('/main/perencanaan/penanganan/konsultasi_perencanaan/create', 'MAIN\bk010304Controller@post_create');
// Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/delete', 'MAIN\bk010304Controller@delete');
// Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/show', 'MAIN\bk010304Controller@show');

Route::get('/main/perencanaan/penyusunan', 'MAIN\bk010320Controller@index');
Route::get('/main/perencanaan/penyusunan/select', 'MAIN\bk010320Controller@select');
Route::post('/main/perencanaan/penyusunan', 'MAIN\bk010320Controller@post');
Route::get('/main/perencanaan/penyusunan/create', 'MAIN\bk010320Controller@create');
Route::post('/main/perencanaan/penyusunan/create', 'MAIN\bk010320Controller@post_create');
Route::get('/main/perencanaan/penyusunan/delete', 'MAIN\bk010320Controller@delete');
Route::get('/main/perencanaan/penyusunan/show', 'MAIN\bk010320Controller@show');

Route::get('/main/perencanaan/penanganan/lokasi_profile', 'MAIN\bk010305Controller@index');
Route::get('/main/perencanaan/penanganan/lokasi_profile/select', 'MAIN\bk010305Controller@select');
Route::post('/main/perencanaan/penanganan/lokasi_profile', 'MAIN\bk010305Controller@post');
Route::get('/main/perencanaan/penanganan/lokasi_profile/create', 'MAIN\bk010305Controller@create');
Route::post('/main/perencanaan/penanganan/lokasi_profile/create', 'MAIN\bk010305Controller@post_create');
Route::get('/main/perencanaan/penanganan/lokasi_profile/delete', 'MAIN\bk010305Controller@delete');
Route::get('/main/perencanaan/penanganan/lokasi_profile/show', 'MAIN\bk010305Controller@show');

Route::get('/main/perencanaan/penanganan/profile_rencana_5thn', 'MAIN\bk010306Controller@index');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/select', 'MAIN\bk010306Controller@select');
Route::post('/main/perencanaan/penanganan/profile_rencana_5thn', 'MAIN\bk010306Controller@post');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/create', 'MAIN\bk010306Controller@create');
Route::post('/main/perencanaan/penanganan/profile_rencana_5thn/create', 'MAIN\bk010306Controller@post_create');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/delete', 'MAIN\bk010306Controller@delete');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/show', 'MAIN\bk010306Controller@show');

Route::get('/main/perencanaan/penanganan/rencana_investasi', 'MAIN\bk010307Controller@index');
Route::get('/main/perencanaan/penanganan/rencana_investasi/select', 'MAIN\bk010307Controller@select');
Route::post('/main/perencanaan/penanganan/rencana_investasi', 'MAIN\bk010307Controller@post');
Route::get('/main/perencanaan/penanganan/rencana_investasi/create', 'MAIN\bk010307Controller@create');
Route::post('/main/perencanaan/penanganan/rencana_investasi/create', 'MAIN\bk010307Controller@post_create');
Route::get('/main/perencanaan/penanganan/rencana_investasi/delete', 'MAIN\bk010307Controller@delete');
Route::get('/main/perencanaan/penanganan/rencana_investasi/show', 'MAIN\bk010307Controller@show');

Route::get('/main/perencanaan/penanganan/pengamanan_dampak', 'MAIN\bk010308Controller@index');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/select', 'MAIN\bk010308Controller@select');
Route::post('/main/perencanaan/penanganan/pengamanan_dampak', 'MAIN\bk010308Controller@post');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/create', 'MAIN\bk010308Controller@create');
Route::post('/main/perencanaan/penanganan/pengamanan_dampak/create', 'MAIN\bk010308Controller@post_create');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/delete', 'MAIN\bk010308Controller@delete');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/show', 'MAIN\bk010308Controller@show');

Route::get('/main/perencanaan/kawasan/perencanaan', 'MAIN\bk010309Controller@index');
Route::post('/main/perencanaan/kawasan/perencanaan', 'MAIN\bk010309Controller@post');
Route::get('/main/perencanaan/kawasan/perencanaan/create', 'MAIN\bk010309Controller@create');
Route::post('/main/perencanaan/kawasan/perencanaan/create', 'MAIN\bk010309Controller@post_create');
Route::get('/main/perencanaan/kawasan/perencanaan/delete', 'MAIN\bk010309Controller@delete');
Route::get('/main/perencanaan/kawasan/perencanaan/select', 'MAIN\bk010309Controller@select');
Route::get('/main/perencanaan/kawasan/perencanaan/show', 'MAIN\bk010309Controller@show');

Route::get('/main/perencanaan/kawasan/investasi', 'MAIN\bk010310Controller@index');
Route::post('/main/perencanaan/kawasan/investasi', 'MAIN\bk010310Controller@post');
Route::get('/main/perencanaan/kawasan/investasi/create', 'MAIN\bk010310Controller@create');
Route::post('/main/perencanaan/kawasan/investasi/create', 'MAIN\bk010310Controller@post_create');
Route::get('/main/perencanaan/kawasan/investasi/delete', 'MAIN\bk010310Controller@delete');
Route::get('/main/perencanaan/kawasan/investasi/select', 'MAIN\bk010310Controller@select');
Route::get('/main/perencanaan/kawasan/investasi/show', 'MAIN\bk010310Controller@show');

Route::get('/main/perencanaan/rencana_kegiatan', 'MAIN\bk010311Controller@index');
Route::post('/main/perencanaan/rencana_kegiatan', 'MAIN\bk010311Controller@post');
Route::get('/main/perencanaan/rencana_kegiatan/create', 'MAIN\bk010311Controller@create');
Route::post('/main/perencanaan/rencana_kegiatan/create', 'MAIN\bk010311Controller@post_create');
Route::get('/main/perencanaan/rencana_kegiatan/delete', 'MAIN\bk010311Controller@delete');
Route::get('/main/perencanaan/rencana_kegiatan/select', 'MAIN\bk010311Controller@select');
Route::get('/main/perencanaan/rencana_kegiatan/show', 'MAIN\bk010311Controller@show');

Route::get('/main/perencanaan/infra/penyiapan_paket', 'MAIN\bk010312Controller@index');
Route::post('/main/perencanaan/infra/penyiapan_paket', 'MAIN\bk010312Controller@post');
Route::get('/main/perencanaan/infra/penyiapan_paket/create', 'MAIN\bk010312Controller@create');
Route::post('/main/perencanaan/infra/penyiapan_paket/create', 'MAIN\bk010312Controller@post_create');
Route::get('/main/perencanaan/infra/penyiapan_paket/delete', 'MAIN\bk010312Controller@delete');
Route::get('/main/perencanaan/infra/penyiapan_paket/select', 'MAIN\bk010312Controller@select');
Route::get('/main/perencanaan/infra/penyiapan_paket/show', 'MAIN\bk010312Controller@show');

Route::get('/main/perencanaan/infra/amdal', 'MAIN\bk010313Controller@index');
Route::post('/main/perencanaan/infra/amdal', 'MAIN\bk010313Controller@post');
Route::get('/main/perencanaan/infra/amdal/create', 'MAIN\bk010313Controller@create');
Route::post('/main/perencanaan/infra/amdal/create', 'MAIN\bk010313Controller@post_create');
Route::get('/main/perencanaan/infra/amdal/delete', 'MAIN\bk010313Controller@delete');
Route::get('/main/perencanaan/infra/amdal/select', 'MAIN\bk010313Controller@select');
Route::get('/main/perencanaan/infra/amdal/show', 'MAIN\bk010313Controller@show');

Route::get('/main/perencanaan/pengadaan_lelang', 'MAIN\bk010314Controller@index');
Route::post('/main/perencanaan/pengadaan_lelang', 'MAIN\bk010314Controller@post');
Route::get('/main/perencanaan/pengadaan_lelang/create', 'MAIN\bk010314Controller@create');
Route::post('/main/perencanaan/pengadaan_lelang/create', 'MAIN\bk010314Controller@post_create');
Route::get('/main/perencanaan/pengadaan_lelang/delete', 'MAIN\bk010314Controller@delete');
Route::get('/main/perencanaan/pengadaan_lelang/select', 'MAIN\bk010314Controller@select');
Route::get('/main/perencanaan/pengadaan_lelang/show', 'MAIN\bk010314Controller@show');

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
Route::get('/main/perencanaan/kontrak_paket/show', 'MAIN\bk010315Controller@show');

Route::get('/main/perencanaan/kelurahan/penanganan_kumuh', 'MAIN\bk010316Controller@index');
Route::get('/main/perencanaan/kelurahan/penanganan_kumuh/select', 'MAIN\bk010316Controller@select');
Route::post('/main/perencanaan/kelurahan/penanganan_kumuh', 'MAIN\bk010316Controller@post');
Route::get('/main/perencanaan/kelurahan/penanganan_kumuh/create', 'MAIN\bk010316Controller@create');
Route::post('/main/perencanaan/kelurahan/penanganan_kumuh/create', 'MAIN\bk010316Controller@post_create');
Route::get('/main/perencanaan/kelurahan/penanganan_kumuh/delete', 'MAIN\bk010316Controller@delete');
Route::get('/main/perencanaan/kelurahan/penanganan_kumuh/show', 'MAIN\bk010316Controller@show');

Route::get('/main/perencanaan/kelurahan/penyusunan_rplp', 'MAIN\bk010317Controller@index');
Route::get('/main/perencanaan/kelurahan/penyusunan_rplp/select', 'MAIN\bk010317Controller@select');
Route::post('/main/perencanaan/kelurahan/penyusunan_rplp', 'MAIN\bk010317Controller@post');
Route::get('/main/perencanaan/kelurahan/penyusunan_rplp/create', 'MAIN\bk010317Controller@create');
Route::post('/main/perencanaan/kelurahan/penyusunan_rplp/create', 'MAIN\bk010317Controller@post_create');
Route::get('/main/perencanaan/kelurahan/penyusunan_rplp/delete', 'MAIN\bk010317Controller@delete');
Route::get('/main/perencanaan/kelurahan/penyusunan_rplp/show', 'MAIN\bk010317Controller@show');

Route::get('/main/perencanaan/kelurahan/investasi_5thn', 'MAIN\bk010318Controller@index');
Route::get('/main/perencanaan/kelurahan/investasi_5thn/select', 'MAIN\bk010318Controller@select');
Route::post('/main/perencanaan/kelurahan/investasi_5thn', 'MAIN\bk010318Controller@post');
Route::get('/main/perencanaan/kelurahan/investasi_5thn/create', 'MAIN\bk010318Controller@create');
Route::post('/main/perencanaan/kelurahan/investasi_5thn/create', 'MAIN\bk010318Controller@post_create');
Route::get('/main/perencanaan/kelurahan/investasi_5thn/delete', 'MAIN\bk010318Controller@delete');
Route::get('/main/perencanaan/kelurahan/investasi_5thn/show', 'MAIN\bk010318Controller@show');

Route::get('/main/perencanaan/kelurahan/kegiatan', 'MAIN\bk010319Controller@index');
Route::get('/main/perencanaan/kelurahan/kegiatan/select', 'MAIN\bk010319Controller@select');
Route::post('/main/perencanaan/kelurahan/kegiatan', 'MAIN\bk010319Controller@post');
Route::get('/main/perencanaan/kelurahan/kegiatan/create', 'MAIN\bk010319Controller@create');
Route::post('/main/perencanaan/kelurahan/kegiatan/create', 'MAIN\bk010319Controller@post_create');
Route::get('/main/perencanaan/kelurahan/kegiatan/delete', 'MAIN\bk010319Controller@delete');
Route::get('/main/perencanaan/kelurahan/kegiatan/show', 'MAIN\bk010319Controller@show');

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
