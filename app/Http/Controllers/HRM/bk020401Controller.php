<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020401Controller extends Controller
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
				if($item->kode_menu==182)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 570);
				return view('HRM/bk020401/index',$data);
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
		$user = Auth::user();
		$columns = array(
			0 => 'kode',
			1 => 'periode',
			2 => 'kode_kmp_slum_prog',
			3 => 'kuota_person',
			4 => 'real_person',
			5 => 'persen_real',
			6 => 'created_time',
		);
		$query='select * from bkt_02040301_real_person_kmp ';
		$totalData = DB::select('select count(1) cnt from bkt_02040301_real_person_kmp ');

		$totalFiltered = $totalData[0]->cnt;
		$limit = 1;
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by '.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' where (kode like "%'.$search.'%" or 
												periode like "%'.$search.'%" or
												kode_kmp_slum_prog like "%'.$search.'%" or
												kuota_person like "%'.$search.'%" or
												real_person like "%'.$search.'%" or 
												persen_real like "%'.$search.'%") 
										order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query.' 
										where (kode like "%'.$search.'%" or 
												periode like "%'.$search.'%" or
												kode_kmp_slum_prog like "%'.$search.'%" or
												kuota_person like "%'.$search.'%" or
												real_person like "%'.$search.'%" or 
												persen_real like "%'.$search.'%")
										) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$nestedData['kode'] = $post->kode;
				$nestedData['periode'] = $post->periode;
				$nestedData['nama_belakang'] = $post->nama_belakang;
				$nestedData['kode_kmp_slum_prog'] = $post->kode_kmp_slum_prog;
				$nestedData['kuota_person'] = $post->kuota_person;
				$nestedData['real_person'] = $post->real_person;
				$nestedData['persen_real'] = $post->persen_real;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==182)
							$detil[$item->kode_menu_detil]='a';
					}
				}

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

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 2,
				'kode_modul' => 14,
				'kode_menu' => 182,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
