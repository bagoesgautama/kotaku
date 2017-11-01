<?php

namespace App\Http\Controllers\Registrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;
class RegistrasiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        // parent::__construct();
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function registrasi_create_post(Request $request)
    {
        $date = strtotime($request->input('tgl_lahir'));
        $date_convert = date('Y-m-d', $date);
        DB::table('bkt_02020201_registrasi')->insert([
            'user_name' => $request->input('username'), 
            'password' => Hash::make($request->input('password')), 
            'nama_depan' => $request->input('first_name'), 
            'nama_belakang' => $request->input('last_name'),
            'kode_level' => $request->input('kode_level-input'),
            'kode_role' => $request->input('kode_role-input'),
            'wk_kd_prop' => $request->input('wk_kd_prop-input'),
            'wk_kd_kota' => $request->input('wk_kd_kota-input'),
            'wk_kd_kel' => $request->input('wk_kd_kel-input'),
            'kode_kmp' => $request->input('kode_kmp-input'),
            'kode_kmw' => $request->input('kode-kmw-input'),
            'kode_korkot' => $request->input('kode-korkot-input'),
            'kode_faskel' => $request->input('kode-faskel-input'),
            'kode_prop' => $request->input('kode_prop-input'),
            'kode_kota' => $request->input('kode_kota-input'),
            'kode_kec' => $request->input('kode_kecamatan-input'),
            'kode_kel' => $request->input('kode_kelurahan-input'),
            'alamat' => $request->input('alamat'),
            'kodepos' => $request->input('kodepos'),
            'kode_jenis_kelamin' => $request->input('kode-jk'),
            'tgl_lahir' => $date_convert,
            'kode_tempat_lahir' => $request->input('kode_tempat_lahir-input'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'jenis_registrasi' => $request->input('kode-jr')
        ]);

        return Redirect::to('login');
    }
}
