<?php

namespace App\Http\Controllers\Registrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Mail;
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
        $date2 = strtotime($request->input('tgl_spk'));
        $date_convert2 = date('Y-m-d', $date2);
        DB::table('bkt_02020201_registrasi')->insert([
            'user_name' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'nama_depan' => $request->input('first_name'),
            'nama_belakang' => $request->input('last_name'),
            'nik' => $request->input('nik'),
            'no_npwp' => $request->input('no_npwp'),
            'no_spk' => $request->input('no_spk'),
            'tgl_spk' => $request->input('tgl_spk')==null?null:$date_convert2,
            'nama_bank' => $request->input('nama_bank'),
            'no_rekening' => $request->input('no_rekening'),
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
            'tgl_lahir' => $request->input('tgl_lahir')==null?null:$date_convert,
            'kode_tempat_lahir' => $request->input('kode_tempat_lahir-input'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'no_telp' => $request->input('no_telp'),
            'jenis_registrasi' => $request->input('kode-jr')
        ]);
		$list=DB::select('select *
		  from bkt_02010111_user
		 where (kode_role, ifnull(kode_kmp,'x'), ifnull(kode_kmw,'x'), ifnull(wk_kd_prop,'x'),
				ifnull(wk_kd_kota,'x'), ifnull(wk_kd_kel,'x'))
			in (
				select x.kode_role_upper,
					   case when x.kode_level_upper = 0 then 'x' else x.kode_kmp end kode_kmp,
					   case when x.kode_level_upper = 0 then 'x' else x.kode_kmw end kode_kmw,
					   case when x.kode_level_upper in (0,1) then 'x' else x.kode_prop end wk_kd_prop,
					   case when x.kode_level_upper in (0,1,2) then 'x' else x.kode_kota end wk_kd_kota,
					   case when x.kode_level_upper in (0,1,2,3) then 'x' else x.kode_kel end wk_kd_kel
				  from (
						select a.kode_level, a.kode_role, b.kode_role_upper, a.kode_kmp, a.kode_kmw,
							   a.kode_korkot, a.kode_faskel, d.kode kode_prop, ifnull(a.wk_kd_kota, h.kode_kota) kode_kota,
							   ifnull(a.wk_kd_kel, i.kode_kel) kode_kel, e.kode_level kode_level_upper
						  from bkt_02020201_registrasi a
						  join bkt_02010102_role b on a.kode_role = b.kode
						  join bkt_02010101_role_level c on b.kode_level = c.kode
						  left join bkt_01010101_prop d on a.wk_kd_prop = d.kode
						  left join bkt_02010102_role e on e.kode = b.kode_role_upper
						  left join bkt_01010111_korkot f on f.kode = a.kode_korkot
						  left join bkt_01010113_faskel g on g.kode = a.kode_faskel
						  left join bkt_01010112_kota_korkot h on h.kode_korkot = f.kode
						  left join bkt_01010114_kel_faskel i on i.kode_faskel = g.kode
						 where a.user_name = '.$request->input('username').'
					   ) x
		       )');
		if(!empty($list)){
			$mail=new Array();
			foreach ($list as $post){
				DB::table('bkt_02030205_pesan')->insert(
					['kode_user' => $post->id,
					'text_pesan' => 'Harap verifikasi personil baru yang mendaftar '.$request->input('username'),
					'status' => 0
				]);
				array_push($mail, $post->email);
			}
			Mail::raw('Harap verifikasi personil baru yang mendaftar '.$request->input('username'), function($message){
				$message->from('kotakudemo@gmail.com', 'Sim HRM');
				$message->to($mail);
			})
		}else{
			DB::table('bkt_02030205_pesan')->insert(
				['kode_user' => 1,
				'text_pesan' => 'Harap verifikasi personil baru yang mendaftar '.$request->input('username'),
				'status' => 0
			]);
		}

		return Redirect::to('login');
    }
}
