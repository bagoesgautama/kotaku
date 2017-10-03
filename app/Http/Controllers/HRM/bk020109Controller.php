<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020109Controller extends Controller
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
				if($item->kode_menu==10)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');
				return view('HRM/bk020109/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function show(Request $request)
	{
		$data = DB::select('select menu.*,case when ISNULL(kode) then "0" else "1" end akses from (select a.kode menu_id,a.nama menu,b.nama detil,b.kode detil_id
			from bkt_02010106_menu a,bkt_02010108_menu_detil b
			where b.kode_menu=a.kode and a.kode_modul='.$request->modul.')menu
			left join (select * from bkt_02010109_akses_role_detail where kode_role='.$request->role.') akses
			on detil_id=akses.kode_menu_detil');
		echo json_encode($data);
	}

	public function post(Request $request)
	{
		$json=$request->json()->all();
		DB::beginTransaction();
		foreach ($json as $item) {
		    if($item['flag']==1)
				DB::table('bkt_02010109_akses_role_detail')->insert(
					['kode_modul' => $item['modul'],
					'kode_apps' => $item['apps'],
					'kode_menu' => $item['menu_id'],
					'kode_menu_detil'=>$item['detil_id'],
					'kode_role'=>$item['role'],
					'created_by'=>Auth::user()->id]
				);
			else
				DB::table('bkt_02010109_akses_role_detail')->
				where([['kode_menu', '=', $item['menu_id']],
				['kode_menu_detil', '=', $item['detil_id']],['kode_role', '=', $item['role']]])->delete();
		}
		DB::commit();
	}
}
