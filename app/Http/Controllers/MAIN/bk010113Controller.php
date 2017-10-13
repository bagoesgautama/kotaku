<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010113Controller extends Controller
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
				if($item->kode_menu==30)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');
				
				$this->log_aktivitas('View', 52);
				return view('MAIN/bk010113/index',$data);
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
		return view('main/faskel',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode_kmw',
			1 =>'kode_korkot',
			2 =>'nama',
			3 =>'created_time',
			4 =>'created_by',
			5 =>'updated_time',
			6 =>'updated_by'
		);
		$query='select a.*, b.nama nama_kmw, c.nama nama_korkot from bkt_01010113_faskel a, bkt_01010110_kmw b, bkt_01010111_korkot c where (b.kode = a.kode_kmw and c.kode = a.kode_korkot) ';
		$totalData = DB::select('select count(1) cnt from bkt_01010113_faskel ');
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
			$posts=DB::select($query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/faskel/create?kode=".$show;
				$url_delete=url('/')."/main/faskel/delete?kode=".$delete;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama'] = $post->nama;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==30)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['54'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['55'])){
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
				if($item->kode_menu==30)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		
		//get dropdown list from Database
		$kode_kmw_list = DB::select('select kode, nama from bkt_01010110_kmw');
		$data['kode_kmw_list'] = $kode_kmw_list;

		$kode_korkot_list = DB::select('select kode, nama from bkt_01010111_korkot');
		$data['kode_korkot_list'] = $kode_korkot_list;

		if($data['kode']!=null && !empty($data['detil']['54'])){
			$rowData = DB::select('select * from bkt_01010113_faskel where kode='.$data['kode']);
			$data['kode_kmw'] = $rowData[0]->kode_kmw;
			$data['kode_korkot'] = $rowData[0]->kode_korkot;
			$data['nama'] = $rowData[0]->nama;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
			return view('MAIN/bk010113/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['53'])){
			$data['kode_kmw'] = null;
			$data['kode_korkot'] = null;
			$data['nama'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;

		return view('MAIN/bk010113/create',$data);
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
			DB::table('bkt_01010113_faskel')->where('kode', $request->input('example-id-input'))
			->update(['kode_kmw' => $request->input('select-kode_kmw-input'), 
				'kode_korkot' => $request->input('select-kode_korkot-input'), 
				'nama' => $request->input('nama-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 54);

		}else{
			DB::table('bkt_01010113_faskel')->insert(
       			['kode_kmw' => $request->input('select-kode_kmw-input'), 
				'kode_korkot' => $request->input('select-kode_korkot-input'), 
				'nama' => $request->input('nama-input'),
       			'created_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Create', 53);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010113_faskel')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 55);
        return Redirect::to('/main/faskel');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 2, 
				'kode_menu' => 30,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
