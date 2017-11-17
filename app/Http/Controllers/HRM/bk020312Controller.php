<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;

class bk020312Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==199)
					$data['detil'][$item->kode_menu_detil]='a';
			}
		}else{
			return Redirect::to('/');
		}
		$data['username'] = $user->name;
		$data['user']=$user;
		return view('HRM/bk020312/index',$data);
    }

	public function Post(Request $request)
	{
		$user = Auth::user();
		$file3 = $request->file('uri_img_profile-input');
		$url3 = null;
		$upload3 = false;
		if($request->input('uri_img_profile-file') != null && $file3 == null){
			$url3 = $request->input('uri_img_profile-file');
			$upload3 = false;
		}else if($file3 != null){
			$url3 = $user->id."_".$file3->getClientOriginalName();
			$upload3 = true;
		}
		date_default_timezone_set('Asia/Jakarta');
		DB::table('bkt_02010111_user')->where('id', $user->id)
		->update(['nama_depan' => $request->input('nama_depan-input'),
			'nama_belakang' => $request->input('nama_belakang-input'),
			'alamat' => $request->input('alamat-input'),
			'email' => $request->input('email-input'),
			'no_hp' => $request->input('no_hp-input'),
			'no_hp2' => $request->input('no_hp2-input'),
			'uri_img_profile' => $url3,
			'updated_time' => date('Y-m-d H:i:s'),
			'updated_by' => Auth::user()->id
			]);
		if($upload3 == true){
			$file3->move(public_path('/uploads/profil'), $user->id."_".$file3->getClientOriginalName());
		}
		$this->log_aktivitas('Update Profil', 619);
		echo "true";
	}

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 16,
			'kode_menu' => 199,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
