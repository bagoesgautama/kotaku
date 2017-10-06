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

//master data
//gis Provinsi
Route::get('/main/data_wilayah/provinsi', 'MAIN\bk010101Controller@index');
Route::post('/main/data_wilayah/provinsi', 'MAIN\bk010101Controller@post');
Route::get('/main/data_wilayah/provinsi/create', 'MAIN\bk010101Controller@create');
Route::post('/main/data_wilayah/provinsi/create', 'MAIN\bk010101Controller@post_create');
Route::get('/main/data_wilayah/provinsi/delete', 'MAIN\bk010101Controller@delete');

//gis kota
Route::get('/main/data_wilayah/kota', 'MAIN\bk010102Controller@index');
Route::post('/main/data_wilayah/kota', 'MAIN\bk010102Controller@post');
Route::get('/main/data_wilayah/kota/create', 'MAIN\bk010102Controller@create');
Route::post('/main/data_wilayah/kota/create', 'MAIN\bk010102Controller@post_create');
Route::get('/main/data_wilayah/kota/delete', 'MAIN\bk010102Controller@delete');

//gis kecamatan
Route::get('/main/data_wilayah/kecamatan', 'MAIN\bk010103Controller@index');
Route::post('/main/data_wilayah/kecamatan', 'MAIN\bk010103Controller@post');
Route::get('/main/data_wilayah/kecamatan/create', 'MAIN\bk010103Controller@create');
Route::post('/main/data_wilayah/kecamatan/create', 'MAIN\bk010103Controller@post_create');
Route::get('/main/data_wilayah/kecamatan/delete', 'MAIN\bk010103Controller@delete');

//gis kelurahan
Route::get('/main/data_wilayah/kelurahan', 'MAIN\bk010104Controller@index');
Route::post('/main/data_wilayah/kelurahan', 'MAIN\bk010104Controller@post');
Route::get('/main/data_wilayah/kelurahan/create', 'MAIN\bk010104Controller@create');
Route::post('/main/data_wilayah/kelurahan/create', 'MAIN\bk010104Controller@post_create');
Route::get('/main/data_wilayah/kelurahan/delete', 'MAIN\bk010104Controller@delete');

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

//kecamatan
Route::get('/main/persiapan/kecamatan/bkm', 'MAIN\bk010212Controller@index');
Route::post('/main/persiapan/kecamatan/bkm', 'MAIN\bk010212Controller@post');
Route::get('/main/persiapan/kecamatan/bkm/create', 'MAIN\bk010212Controller@create');
Route::post('/main/persiapan/kecamatan/bkm/create', 'MAIN\bk010212Controller@post_create');
Route::get('/main/persiapan/kecamatan/bkm/delete', 'MAIN\bk010212Controller@delete');

Route::get('/main/persiapan/kecamatan/kolaborasi', 'MAIN\bk010213Controller@index');
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
Route::post('/main/persiapan/kelurahan/info', 'MAIN\bk010215Controller@post');
Route::get('/main/persiapan/kelurahan/info/create', 'MAIN\bk010215Controller@create');
Route::post('/main/persiapan/kelurahan/info/create', 'MAIN\bk010215Controller@post_create');
Route::get('/main/persiapan/kelurahan/info/delete', 'MAIN\bk010215Controller@delete');

Route::get('/main/persiapan/kelurahan/sosialisasi', 'MAIN\bk010216Controller@index');
Route::post('/main/persiapan/kelurahan/sosialisasi', 'MAIN\bk010216Controller@post');
Route::get('/main/persiapan/kelurahan/sosialisasi/create', 'MAIN\bk010216Controller@create');
Route::post('/main/persiapan/kelurahan/sosialisasi/create', 'MAIN\bk010216Controller@post_create');
Route::get('/main/persiapan/kelurahan/sosialisasi/delete', 'MAIN\bk010216Controller@delete');

Route::get('/main/persiapan/kelurahan/relawan', 'MAIN\bk010217Controller@index');
Route::post('/main/persiapan/kelurahan/relawan', 'MAIN\bk010217Controller@post');
Route::get('/main/persiapan/kelurahan/relawan/create', 'MAIN\bk010217Controller@create');
Route::post('/main/persiapan/kelurahan/relawan/create', 'MAIN\bk010217Controller@post_create');
Route::get('/main/persiapan/kelurahan/relawan/delete', 'MAIN\bk010217Controller@delete');

Route::get('/main/persiapan/kelurahan/agen_sosialisasi', 'MAIN\bk010218Controller@index');
Route::post('/main/persiapan/kelurahan/agen_sosialisasi', 'MAIN\bk010218Controller@post');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/create', 'MAIN\bk010218Controller@create');
Route::post('/main/persiapan/kelurahan/agen_sosialisasi/create', 'MAIN\bk010218Controller@post_create');
Route::get('/main/persiapan/kelurahan/agen_sosialisasi/delete', 'MAIN\bk010218Controller@delete');

Route::get('/main/persiapan/kelurahan/pelatihan', 'MAIN\bk010219Controller@index');
Route::post('/main/persiapan/kelurahan/pelatihan', 'MAIN\bk010219Controller@post');
Route::get('/main/persiapan/kelurahan/pelatihan/create', 'MAIN\bk010219Controller@create');
Route::post('/main/persiapan/kelurahan/pelatihan/create', 'MAIN\bk010219Controller@post_create');
Route::get('/main/persiapan/kelurahan/pelatihan/delete', 'MAIN\bk010219Controller@delete');

Route::get('/main/persiapan/kelurahan/forum/keanggotaan', 'MAIN\bk010220Controller@index');
Route::post('/main/persiapan/kelurahan/forum/keanggotaan', 'MAIN\bk010220Controller@post');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/create', 'MAIN\bk010220Controller@create');
Route::post('/main/persiapan/kelurahan/forum/keanggotaan/create', 'MAIN\bk010220Controller@post_create');
Route::get('/main/persiapan/kelurahan/forum/keanggotaan/delete', 'MAIN\bk010220Controller@delete');

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

Route::get('/main/persiapan/kelurahan/lembaga/tapp', 'MAIN\bk010223Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/tapp', 'MAIN\bk010223Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/tapp/create', 'MAIN\bk010223Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/tapp/create', 'MAIN\bk010223Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/tapp/delete', 'MAIN\bk010223Controller@delete');

Route::get('/main/persiapan/kelurahan/lembaga/tipp', 'MAIN\bk010224Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/tipp', 'MAIN\bk010224Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/tipp/create', 'MAIN\bk010224Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/tipp/create', 'MAIN\bk010224Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/tipp/delete', 'MAIN\bk010224Controller@delete');

Route::get('/main/persiapan/kelurahan/lembaga/organisasai_pengelola', 'MAIN\bk010225Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/organisasai_pengelola', 'MAIN\bk010225Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/organisasai_pengelola/create', 'MAIN\bk010225Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/organisasai_pengelola/create', 'MAIN\bk010225Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/organisasai_pengelola/delete', 'MAIN\bk010225Controller@delete');

Route::get('/main/persiapan/kelurahan/lembaga/ksm/ppmk', 'MAIN\bk010226Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/ksm/ppmk', 'MAIN\bk010226Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/ksm/ppmk/create', 'MAIN\bk010226Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/ksm/ppmk/create', 'MAIN\bk010226Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/ksm/ppmk/delete', 'MAIN\bk010226Controller@delete');

Route::get('/main/persiapan/kelurahan/lembaga/ksm/syariah', 'MAIN\bk010227Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/ksm/syariah', 'MAIN\bk010227Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/ksm/syariah/create', 'MAIN\bk010227Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/ksm/syariah/create', 'MAIN\bk010227Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/ksm/syariah/delete', 'MAIN\bk010227Controller@delete');

Route::get('/main/persiapan/kelurahan/lembaga/ksm/fasil_bdc', 'MAIN\bk010228Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/ksm/fasil_bdc', 'MAIN\bk010228Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/ksm/fasil_bdc/create', 'MAIN\bk010228Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/ksm/fasil_bdc/create', 'MAIN\bk010228Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/ksm/fasil_bdc/delete', 'MAIN\bk010228Controller@delete');

Route::get('/main/persiapan/kelurahan/lembaga/ksm/tabungan', 'MAIN\bk010229Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/ksm/tabungan', 'MAIN\bk010229Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/ksm/tabungan/create', 'MAIN\bk010229Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/ksm/tabungan/create', 'MAIN\bk010229Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/ksm/tabungan/delete', 'MAIN\bk010229Controller@delete');

Route::get('/main/persiapan/kelurahan/lembaga/bdc', 'MAIN\bk010230Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/bdc', 'MAIN\bk010230Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/bdc/create', 'MAIN\bk010230Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/bdc/create', 'MAIN\bk010230Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/bdc/delete', 'MAIN\bk010230Controller@delete');

Route::get('/main/persiapan/kelurahan/lembaga/federasi_upk', 'MAIN\bk010231Controller@index');
Route::post('/main/persiapan/kelurahan/lembaga/federasi_upk', 'MAIN\bk010231Controller@post');
Route::get('/main/persiapan/kelurahan/lembaga/federasi_upk/create', 'MAIN\bk010231Controller@create');
Route::post('/main/persiapan/kelurahan/lembaga/federasi_upk/create', 'MAIN\bk010231Controller@post_create');
Route::get('/main/persiapan/kelurahan/lembaga/federasi_upk/delete', 'MAIN\bk010231Controller@delete');


//perencanaan
Route::get('/main/perencanaan/penanganan/pembangunan_visi', 'MAIN\bk010301Controller@index');
Route::post('/main/perencanaan/penanganan/pembangunan_visi', 'MAIN\bk010301Controller@post');
Route::get('/main/perencanaan/penanganan/pembangunan_visi/create', 'MAIN\bk010301Controller@create');
Route::post('/main/perencanaan/penanganan/pembangunan_visi/create', 'MAIN\bk010301Controller@post_create');
Route::get('/main/perencanaan/penanganan/pembangunan_visi/delete', 'MAIN\bk010301Controller@delete');

Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk', 'MAIN\bk010302Controller@index');
Route::post('/main/perencanaan/penanganan/pelaksanaan_rpk', 'MAIN\bk010302Controller@post');
Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/create', 'MAIN\bk010302Controller@create');
Route::post('/main/perencanaan/penanganan/pelaksanaan_rpk/create', 'MAIN\bk010302Controller@post_create');
Route::get('/main/perencanaan/penanganan/pelaksanaan_rpk/delete', 'MAIN\bk010302Controller@delete');

Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan', 'MAIN\bk010303Controller@index');
Route::post('/main/perencanaan/penanganan/lokakarya_perencanaan', 'MAIN\bk010303Controller@post');
Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/create', 'MAIN\bk010303Controller@create');
Route::post('/main/perencanaan/penanganan/lokakarya_perencanaan/create', 'MAIN\bk010303Controller@post_create');
Route::get('/main/perencanaan/penanganan/lokakarya_perencanaan/delete', 'MAIN\bk010303Controller@delete');

Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan', 'MAIN\bk010304Controller@index');
Route::post('/main/perencanaan/penanganan/konsultasi_perencanaan', 'MAIN\bk010304Controller@post');
Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/create', 'MAIN\bk010304Controller@create');
Route::post('/main/perencanaan/penanganan/konsultasi_perencanaan/create', 'MAIN\bk010304Controller@post_create');
Route::get('/main/perencanaan/penanganan/konsultasi_perencanaan/delete', 'MAIN\bk010304Controller@delete');

Route::get('/main/perencanaan/penanganan/lokasi_profile', 'MAIN\bk010305Controller@index');
Route::post('/main/perencanaan/penanganan/lokasi_profile', 'MAIN\bk010305Controller@post');
Route::get('/main/perencanaan/penanganan/lokasi_profile/create', 'MAIN\bk010305Controller@create');
Route::post('/main/perencanaan/penanganan/lokasi_profile/create', 'MAIN\bk010305Controller@post_create');
Route::get('/main/perencanaan/penanganan/lokasi_profile/delete', 'MAIN\bk010305Controller@delete');

Route::get('/main/perencanaan/penanganan/profile_rencana_5thn', 'MAIN\bk010306Controller@index');
Route::post('/main/perencanaan/penanganan/profile_rencana_5thn', 'MAIN\bk010306Controller@post');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/create', 'MAIN\bk010306Controller@create');
Route::post('/main/perencanaan/penanganan/profile_rencana_5thn/create', 'MAIN\bk010306Controller@post_create');
Route::get('/main/perencanaan/penanganan/profile_rencana_5thn/delete', 'MAIN\bk010306Controller@delete');

Route::get('/main/perencanaan/penanganan/rencana_investasi', 'MAIN\bk010307Controller@index');
Route::post('/main/perencanaan/penanganan/rencana_investasi', 'MAIN\bk010307Controller@post');
Route::get('/main/perencanaan/penanganan/rencana_investasi/create', 'MAIN\bk010307Controller@create');
Route::post('/main/perencanaan/penanganan/rencana_investasi/create', 'MAIN\bk010307Controller@post_create');
Route::get('/main/perencanaan/penanganan/rencana_investasi/delete', 'MAIN\bk010307Controller@delete');

Route::get('/main/perencanaan/penanganan/pengamanan_dampak', 'MAIN\bk010308Controller@index');
Route::post('/main/perencanaan/penanganan/pengamanan_dampak', 'MAIN\bk010308Controller@post');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/create', 'MAIN\bk010308Controller@create');
Route::post('/main/perencanaan/penanganan/pengamanan_dampak/create', 'MAIN\bk010308Controller@post_create');
Route::get('/main/perencanaan/penanganan/pengamanan_dampak/delete', 'MAIN\bk010308Controller@delete');

/**
 *
 *
 *module GIS route here
 */
Route::get('/gis', 'GIS\bk040101Controller@index');
Route::get('/gis/map-kota', 'GIS\bk040101Controller@kota');
Route::get('/gis/map-kecamatan', 'GIS\bk040101Controller@kecamatan');


Auth::routes();
