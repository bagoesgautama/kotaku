<?php

namespace App\Http\Controllers\Registrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
            'password' => $request->input('password'), 
            'nama_depan' => $request->input('first_name'), 
            'nama_belakang' => $request->input('last_name'),
            // 'kode_level' => $request->input('kode-lvl-input'),
            // 'kode_role' => $request->input('kode-role-input'),
            'alamat' => $request->input('alamat'),
            'kodepos' => $request->input('kodepos'),
            'kode_jenis_kelamin' => $request->input('kode-jk'),
            'tgl_lahir' => $date_convert,
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'jenis_registrasi' => $request->input('kode-jr')
        ]);

        return Redirect::to('login');
    }
}
