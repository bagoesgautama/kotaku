<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010112Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // parent::__construct();
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==29)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');
				
				$this->log_aktivitas('View', 48);
				return view('MAIN/bk010112/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function show()
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('main/kota_korkot',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode_korkot',
			1 =>'kode_kota',
			2 =>'ms_kode',
			3 =>'ms_paket,',
			4 =>'created_time',
			5 =>'created_by',
			6 =>'updated_time',
			7 =>'updated_by'
		);
		$query='select a.*, b.nama nama_korkot, c.nama nama_kota from bkt_01010112_kota_korkot a, bkt_01010102_kota b, bkt_01010111_korkot c where a.kode_kota=b.kode and a.kode_korkot=c.kode ';
		$totalData = DB::select('select count(1) cnt from bkt_01010112_kota_korkot ');
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
			$posts=DB::select($query. 'and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. 'and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/kota_korkot/create?kode=".$show;
				$url_delete=url('/')."/main/kota_korkot/delete?kode=".$delete;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['ms_kode'] = $post->ms_kode;
				$nestedData['ms_paket'] = $post->ms_paket;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==29)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['50'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['51'])){
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
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==29)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		
		//get dropdown list from Database
		$kode_korkot_list = DB::select('select kode, nama from bkt_01010111_korkot');
		$data['kode_korkot_list'] = $kode_korkot_list;

		$kode_kota_list = DB::select('select kode, nama from bkt_01010102_kota');
		$data['kode_kota_list'] = $kode_kota_list;

		if($data['kode']!=null && !empty($data['detil']['50'])){
			$rowData = DB::select('select * from bkt_01010112_kota_korkot where kode='.$data['kode']);
			$data['kode_korkot'] = $rowData[0]->kode_korkot;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['ms_kode'] = $rowData[0]->ms_kode;
			$data['ms_paket'] = $rowData[0]->ms_paket;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
			return view('MAIN/bk010112/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['49'])){
			$data['kode_korkot'] = null;
			$data['kode_kota'] = null;
			$data['ms_kode'] = null;
			$data['ms_paket'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;

		return view('MAIN/bk010112/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_01010112_kota_korkot')->where('kode', $request->input('example-id-input'))
			->update(['kode_korkot' => $request->input('example-kode_korkot-input'), 
				'kode_kota' => $request->input('example-kode_kota-input'), 
				'ms_kode' => $request->input('example-select-ms_kode'),
				'ms_paket' => $request->input('example-select-ms_paket'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 50);

		}else{
			DB::table('bkt_01010112_kota_korkot')->insert(
       			['kode_korkot' => $request->input('example-kode_korkot-input'), 
				'kode_kota' => $request->input('example-kode_kota-input'), 
				'ms_kode' => $request->input('example-select-ms_kode'),
				'ms_paket' => $request->input('example-select-ms_paket'), 
       			'created_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Create', 49);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010112_kota_korkot')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 51);
        return Redirect::to('/main/kota_korkot');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 2, 
				'kode_menu' => 29,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
