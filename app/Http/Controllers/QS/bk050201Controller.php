<?php

namespace App\Http\Controllers\QS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk050201Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 491);
				$data['agenda'] = DB::select('select kode_slum_prog,nama from bkt_05010101_agenda where status =1');
				return view('QS/bk050201/index',$data);
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
		echo "a";
		/*$columns = array(
			0 =>'id',
			1 =>'kode_keg_kel',
			2 =>'no_urut',
			3 =>'nama_kegiatan',
			4 =>'tgl_mulai',
			5 =>'tgl_selesai',
			6 =>'status'
		);

		$query='';
		$totalData = DB::select('select count(1) cnt from bkt_05010104_schedule a where a.status !=2');
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
			$posts=DB::select($query. ' and a.nama_kegiatan like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and a.nama_kegiatan like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->id;
				$url_edit="/qs/master/kegiatan_kota/create?id=".$edit;
				$url_delete="/qs/master/kegiatan_kota/delete?id=".$edit;
				$nestedData['id'] = $post->id;
				$nestedData['kode_keg_kel'] = $post->kode_keg_kel;
				$nestedData['no_urut'] = $post->no_urut;
				$nestedData['nama_kegiatan'] = $post->nama_kegiatan;
				$nestedData['tgl_mulai'] = $post->tgl_mulai;
				$nestedData['tgl_selesai'] = $post->tgl_selesai;
				$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 5)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==153)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['493'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['494'])){
					$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				}
				$nestedData['option'] = $option;
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
		*/
	}

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 5,
			'kode_modul' => 10,
			'kode_menu' => 153,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
