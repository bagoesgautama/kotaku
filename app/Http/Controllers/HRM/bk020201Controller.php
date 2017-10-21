<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020201Controller extends Controller
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
				if($item->kode_menu==159)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				return view('HRM/bk020201/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'user',
			2 =>'apps',
			3 =>'modul',
			4 =>'menu',
			5 =>'aktifitas',
			6 =>'created_time'
		);
		$query='select a.kode,a.aktifitas,a.created_time,b.nama apps,c.nama modul,d.nama menu,f.user_name user
			from bkt_02030201_log_aktivitas a,bkt_02010103_apps b,bkt_02010104_modul c,bkt_02010106_menu d,bkt_02010111_user f
			where a.kode_apps=b.kode
			and a.kode_modul=c.kode
			and a.kode_menu=d.kode
			and a.kode_user=f.id';
		$totalData = DB::select('select count(1) cnt from bkt_02030201_log_aktivitas ');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by '.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and f.user_name like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and f.user_name like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$nestedData['kode'] = $post->kode;
				$nestedData['user'] = $post->user;
				$nestedData['apps'] = $post->apps;
				$nestedData['modul'] = $post->modul;
				$nestedData['menu'] = $post->menu;
				$nestedData['aktifitas'] = $post->aktifitas;
				$nestedData['created_time'] = $post->created_time;
				$data[] = $nestedData;
			}
		}

		$json_data = array(
					"draw"            => intval($request->input('draw')),
					"recordsTotal"    => intval($totalData[0]->cnt),
					"recordsFiltered" => intval($totalFiltered),
					"data"            => $data
					);

		echo json_encode($json_data);
	}
}
