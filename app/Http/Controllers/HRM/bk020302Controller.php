<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;

class bk020302Controller extends Controller
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
				if($item->kode_menu==168)
					$data['detil'][$item->kode_menu_detil]='a';
			}

		}else{
			return Redirect::to('/');
		}
		$data['username'] = $user->name;
		$query='select Date_Format(tgl_aktivasi ,"%m"),Date_Format(curdate(),"%m"),DATEDIFF(DATE_FORMAT(now(),"%Y-%m-%d"),DATE_FORMAT(NOW() ,"%Y-%m-01")) from bkt_02010111_user';
		echo date('Y-m-d', strtotime('-1 day'));
		//return view('HRM/bk020302/index',$data);
    }

	public function Post(Request $request)
	{
		$old = $request->input('old-input');
		$new = $request->input('new-input');
		$new2 = $request->input('new2-input');
		$user = Auth::user();
		if (Hash::check($old, $user->password)) {
			if($new==$new2){
				DB::table('bkt_02010111_user')->where('id', $user->id)
				->update(['password' => Hash::make($new),
					'updated_time' => date('Y-m-d H:i:s'),
					'updated_by' => Auth::user()->id
					]);
				echo "true";
			}else{
				echo "Password baru dan konfirmasi tidak sama";
			}
		}else{
			echo "Password lama tidak sesuai";
		}
	}

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 168,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
