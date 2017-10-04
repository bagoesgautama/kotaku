<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020102Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==9)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');
				return view('HRM/bk020102/index',$data);
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
		return view('role',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'a.nama',
			1 =>'a.deskripsi',
			2 =>'nama_status',
			3 =>'nama_level',
			4 =>'a.created_time',
			5 =>'a.created_by',
			6 =>'a.updated_time',
			7 =>'a.updated_by'
		);
		$query='select a.* ,case when (a.status = 0) then "Tidak Aktif" when (a.status = 1) then "Aktif" else "Dihapus" end nama_status , b.nama nama_level from bkt_02010102_role a, bkt_02010101_role_level b where a.kode_level=b.kode and a.status!=2';
		$totalData = DB::select('select count(1) cnt from bkt_02010102_role ');
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
			$posts=DB::select($query. ' and a.nama like "%'.$search.'%" or a.deskripsi like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and a.nama like "%'.$search.'%" or a.deskripsi like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/hrm/role/create?kode=".$show;
				$url_delete=url('/')."/hrm/role/delete?kode=".$delete;
				$nestedData['nama'] = $post->nama;
				$nestedData['deskripsi'] = $post->deskripsi;
				$nestedData['status'] = $post->nama_status;
				$nestedData['nama_level'] = $post->nama_level;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==9)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['17'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['18'])){
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
		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		if($data['kode']!=null){
			$rowData = DB::select('select * from bkt_02010102_role where kode='.$data['kode']);
			$data['nama'] = $rowData[0]->nama;
			$data['deskripsi'] = $rowData[0]->deskripsi;
			$data['status'] = $rowData[0]->status;
			$data['kode_level'] = $rowData[0]->kode_level;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
		}else{
			$data['nama'] = null;
			$data['deskripsi'] = null;
			$data['status'] = null;
			$data['kode_level'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;
		}

		//get dropdown list from Database
		$kode_level = DB::select('select kode, nama from bkt_02010101_role_level where status=1');
		$data['kode_level_list'] = $kode_level;
		
		//echo json_encode($data);
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('HRM/bk020102/create',$data);
	}

	public function post_create(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_02010102_role')->where('kode', $request->input('example-id-input'))
			->update(['nama' => $request->input('example-text-input'), 
				'deskripsi' => $request->input('example-textarea-input'), 
				'status' => $request->input('example-select'), 
				'kode_level' => $request->input('example-select-level'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

		}else{
			DB::table('bkt_02010102_role')->insert(
       			['nama' => $request->input('example-text-input'), 
       			'deskripsi' => $request->input('example-textarea-input'), 
       			'status' => $request->input('example-select'), 
       			'kode_level' => $request->input('example-select-level'), 
       			'created_by' => Auth::user()->id
       			]);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02010102_role')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('hrm/role');
    }
}
