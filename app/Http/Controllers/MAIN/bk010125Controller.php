<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010125Controller extends Controller
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
				if($item->kode_menu==143)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 457);
				return view('MAIN/bk010125/index',$data);
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
			1 =>'kode_ksm',
			2 =>'nama',
			3 =>'alamat',
			4 =>'tgl_pembentukan',
			5 =>'status'
		);
		$query='select id,kode_ksm,nama,alamat,tgl_pembentukan,case when status=1 then "aktif" else "tidak aktif" end status from bkt_01010128_ksm where status !=2';
		$totalData = DB::select('select count(1) cnt from bkt_01010128_ksm where status !=2');
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
			$posts=DB::select($query. ' and nama like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and nama like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->id;
				$url_edit=url('/')."/main/data_master/ksm/create?id=".$edit;
				$url_delete=url('/')."/main/data_master/ksm/delete?id=".$edit;
				$nestedData['id'] = $post->id;
				$nestedData['kode_ksm'] = $post->kode_ksm;
				$nestedData['nama'] = $post->nama;
				$nestedData['alamat'] = $post->alamat;
				$nestedData['tgl_pembentukan'] = $post->tgl_pembentukan;
				$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==143)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['459'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['460'])){
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
				if($item->kode_menu==143)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id']=$request->input('id');
			if($data['id']!=null && !empty($data['detil']['459'])){
				$rowData = DB::select('select * from bkt_01010128_ksm where id='.$data['id']);
				$data['kode_ksm'] = $rowData[0]->kode_ksm;
				$data['nama'] = $rowData[0]->nama;
				$data['alamat'] = $rowData[0]->alamat;
				$data['tgl_pembentukan'] = $rowData[0]->tgl_pembentukan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['status'] = $rowData[0]->status;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('MAIN/bk010125/create',$data);
			}else if($data['id']==null && !empty($data['detil']['458'])){
				$data['kode_ksm'] = null;
				$data['nama'] = null;
				$data['alamat'] = null;
				$data['tgl_pembentukan'] = null;
				$data['q_peserta_p'] = null;
				$data['q_peserta_w'] = null;
				$data['status'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('MAIN/bk010125/create',$data);
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
			DB::table('bkt_01010128_ksm')->where('id', $request->input('id'))
			->update(['kode_ksm' => $request->input('kode_ksm-input'),
				'nama' => $request->input('nama-input'),
				'alamat' => $request->input('alamat-input'),
				'tgl_pembentukan' => $request->input('tgl_pembentukan-input'),
				'q_peserta_p' => $request->input('q_peserta_p-input'),
				'q_peserta_w' => $request->input('q_peserta_w-input'),
				'status' => $request->input('status-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 459);

		}else{
			DB::table('bkt_01010128_ksm')->insert(
       			['kode_ksm' => $request->input('kode_ksm-input'),
				'nama' => $request->input('nama-input'),
				'alamat' => $request->input('alamat-input'),
				'tgl_pembentukan' => $request->input('tgl_pembentukan-input'),
				'q_peserta_p' => $request->input('q_peserta_p-input'),
				'q_peserta_w' => $request->input('q_peserta_w-input'),
				'status' => $request->input('status-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 458);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010128_ksm')->where('id', $request->input('id'))->update(['status' => 2]);
        $this->log_aktivitas('Delete', 460);
        return Redirect::to('/main/data_master/ksm');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 1,
			'kode_modul' => 2,
			'kode_menu' => 143,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
