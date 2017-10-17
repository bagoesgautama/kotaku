<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010120Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==138)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 437);
				return view('MAIN/bk010120/index',$data);
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
			0 =>'id',
			1 =>'subkomponen',
			2 =>'kode_dtl_subkomponen',
			3 =>'detil',
			4 =>'status'
		);
		$query='select a.id,a.kode_dtl_subkomponen,b.nama subkomponen,a.nama detil,case when a.status=1 then "aktif" else "tidak aktif" end status from bkt_01010121_dtl_subkomponen a,bkt_01010120_subkomponen b where a.id_subkomponen=b.id and a.status !=2';
		$totalData = DB::select('select count(1) cnt from bkt_01010121_dtl_subkomponen a,bkt_01010120_subkomponen b where a.id_subkomponen=b.id and a.status !=2');
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
			$posts=DB::select($query. ' and a.nama like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and a.nama like "%'.$search.'%" ) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->id;
				$url_edit=url('/')."/main/data_master/det_komp_keg/create?id=".$edit;
				$url_delete=url('/')."/main/data_master/det_komp_keg/delete?id=".$edit;
				$nestedData['id'] = $post->id;
				$nestedData['kode_dtl_subkomponen'] = $post->kode_dtl_subkomponen;
				$nestedData['subkomponen'] = $post->subkomponen;
				$nestedData['detil'] = $post->detil;
				$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==138)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['439'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['440'])){
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
				if($item->kode_menu==138)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id']=$request->input('id');
			$data['kegiatan'] = DB::select('select id,nama from bkt_01010120_subkomponen');
			if($data['id']!=null && !empty($data['detil']['439'])){
				$rowData = DB::select('select * from bkt_01010121_dtl_subkomponen where id='.$data['id']);
				$data['kode_dtl_subkomponen'] = $rowData[0]->kode_dtl_subkomponen;
				$data['id_subkomponen'] = $rowData[0]->id_subkomponen;
				$data['nama'] = $rowData[0]->nama;
				$data['keterangan'] = $rowData[0]->keterangan;
				$data['satuan'] = $rowData[0]->satuan;
				$data['status'] = $rowData[0]->status;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('MAIN/bk010120/create',$data);
			}else if($data['id']==null && !empty($data['detil']['438'])){
				$data['kode_dtl_subkomponen'] = null;
				$data['id_subkomponen'] = null;
				$data['nama'] = null;
				$data['keterangan'] = null;
				$data['satuan'] = null;
				$data['status'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('MAIN/bk010120/create',$data);
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
		if ($request->input('id')!=null){
			DB::table('bkt_01010121_dtl_subkomponen')->where('id', $request->input('id'))
			->update(['nama' => $request->input('nama-input'),
				'kode_dtl_subkomponen' => $request->input('kode_dtl_subkomponen-input'),
				'id_subkomponen' => $request->input('id_subkomponen-input'),
				'keterangan' => $request->input('keterangan-input'),
				'satuan' => $request->input('satuan-input'),
				'status' => $request->input('status-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 439);

		}else{
			DB::table('bkt_01010121_dtl_subkomponen')->insert(
       			['nama' => $request->input('nama-input'),
				'kode_dtl_subkomponen' => $request->input('kode_dtl_subkomponen-input'),
				'id_subkomponen' => $request->input('id_subkomponen-input'),
				'keterangan' => $request->input('keterangan-input'),
				'satuan' => $request->input('satuan-input'),
				'status' => $request->input('status-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 438);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010121_dtl_subkomponen')->where('id', $request->input('id'))->update(['status' => 2]);
        $this->log_aktivitas('Delete', 440);
        return Redirect::to('/main/data_master/det_komp_keg');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 1,
			'kode_modul' => 2,
			'kode_menu' => 138,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
