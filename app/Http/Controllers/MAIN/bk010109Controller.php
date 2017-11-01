<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010109Controller extends Controller
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
				if($item->kode_menu==26)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 36);
				return view('MAIN/bk010109/index',$data);
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
		return view('main/kmp_slum_program',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'nama_kmp',
			2 =>'nama_slum_prog'
		);
		$query='select a.*, b.nama nama_kmp, c.nama nama_slum_prog 
					from bkt_01010109_kmp_slum_prog a
					left join bkt_01010108_kmp b on a.kode_kmp=b.kode 
					left join bkt_01010107_slum_program c on a.kode_slum_prog=c.kode ';

		$totalData = DB::select('select count(1) cnt from bkt_01010109_kmp_slum_prog a
									left join bkt_01010108_kmp b on a.kode_kmp=b.kode 
									left join bkt_01010107_slum_program c on a.kode_slum_prog=c.kode');
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
			$posts=DB::select($query. ' where (
					b.nama like "%'.$search.'%" or 
					c.nama like "%'.$search.'%" )
					order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					b.nama like "%'.$search.'%" or 
					c.nama like "%'.$search.'%" 
					)) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/kmp_slum_program/create?kode=".$show;
				$url_delete=url('/')."/main/kmp_slum_program/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['nama_kmp'] = $post->nama_kmp;
				$nestedData['nama_slum_prog'] = $post->nama_slum_prog;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==26)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['38'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				/*if(!empty($detil['39'])){
					$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				}*/
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
				if($item->kode_menu==26)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');

		//get dropdown list from Database
		$kode_kmp = DB::select('select kode, nama from bkt_01010108_kmp');
		$data['kode_kmp_list'] = $kode_kmp;

		$kode_slum_prog = DB::select('select kode, nama from bkt_01010107_slum_program');
		$data['kode_slum_prog_list'] = $kode_slum_prog;

		if($data['kode']!=null && !empty($data['detil']['38'])){
			$rowData = DB::select('select * from bkt_01010109_kmp_slum_prog where kode='.$data['kode']);
			$data['kode_kmp'] = $rowData[0]->kode_kmp;
			$data['kode_slum_prog'] = $rowData[0]->kode_slum_prog;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
			return view('MAIN/bk010109/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['37'])){
			$data['kode_kmp'] = null;
			$data['kode_slum_prog'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;

		return view('MAIN/bk010109/create',$data);
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
			DB::table('bkt_01010109_kmp_slum_prog')->where('kode', $request->input('example-id-input'))
			->update(['kode_kmp' => $request->input('select-kode_kmp-input'),
				'kode_slum_prog' => $request->input('select-kode_slum_prog-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 38);

		}else{
			DB::table('bkt_01010109_kmp_slum_prog')->insert(
				['kode_kmp' => $request->input('select-kode_kmp-input'),
				'kode_slum_prog' => $request->input('select-kode_slum_prog-input'),
       			'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 37);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010109_kmp_slum_prog')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 39);
        return Redirect::to('/main/kmp_slum_program');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 2,
				'kode_menu' => 26,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
