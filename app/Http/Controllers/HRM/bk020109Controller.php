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
        //$this->middleware('auth');
        // parent::__construct();
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['username'] = '';
		echo (Auth::user());
	    /*if (Auth::check()) {
            $user = Auth::user();
            $data['username'] = Auth::user()->name;
        }
		$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
			from bkt_02010104_modul b,bkt_02010103_apps c
			where b.kode_apps=c.kode');
		$data['role'] = DB::select('select * from bkt_02010102_role where status=1');
		return view('HRM/bk020109/index',$data);*/
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
					['kode_menu' => $item['menu_id'],
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

	/*public function logout()
    {
        Auth::logout();
    }*/
}
