<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010128Controller extends Controller
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
				if($item->kode_menu==146)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 469);
				return view('MAIN/bk010128/index',$data);
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
			1 =>'nik',
			2 =>'nama',
			2 =>'alamat',
			2 =>'jenis_kelamin',
			3 =>'status'
		);
		$query='select kode,nik,alamat,nama,case when kode_jenis_kelamin="P" then "Pria" else "Wanita" end jenis_kelamin,case when status=1 then "aktif" else "tidak aktif" end status from bkt_01010131_pemanfaat where status !=2';
		$totalData = DB::select('select count(1) cnt from bkt_01010131_pemanfaat where status !=2');
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
				$edit =  $post->kode;
				$url_edit=url('/')."/main/data_master/pemanfaatan/create?kode=".$edit;
				$url_delete=url('/')."/main/data_master/pemanfaatan/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['nik'] = $post->nik;
				$nestedData['nama'] = $post->nama;
				$nestedData['alamat'] = $post->alamat;
				$nestedData['jenis_kelamin'] = $post->jenis_kelamin;
				$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==146)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['471'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['472'])){
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
				if($item->kode_menu==146)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['471'])){
				$rowData = DB::select('select * from bkt_01010131_pemanfaat where kode='.$data['kode']);
				$data['nik'] = $rowData[0]->nik;
				$data['nama'] = $rowData[0]->nama;
				$data['alamat'] = $rowData[0]->alamat;
				$data['kode_jenis_kelamin'] = $rowData[0]->kode_jenis_kelamin;
				$data['flag_mbr'] = $rowData[0]->flag_mbr;
				$data['longitude'] = $rowData[0]->longitude;
				$data['latitude'] = $rowData[0]->latitude;
				$data['status'] = $rowData[0]->status;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('MAIN/bk010128/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['470'])){
				$data['nik'] = null;
				$data['nama'] = null;
				$data['alamat'] = null;
				$data['kode_jenis_kelamin'] = null;
				$data['flag_mbr'] = null;
				$data['longitude'] = null;
				$data['latitude'] = null;
				$data['status'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('MAIN/bk010128/create',$data);
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
		if ($request->input('kode')!=null){
			DB::table('bkt_01010131_pemanfaat')->where('kode', $request->input('kode'))
			->update(['nik' => $request->input('nik-input'),
				'nama' => $request->input('nama-input'),
				'alamat' => $request->input('alamat-input'),
				'kode_jenis_kelamin' => $request->input('kode_jenis_kelamin-input'),
				'flag_mbr' => (int)$request->input('flag_mbr-input'),
				'longitude' => $request->input('longitude-input'),
				'latitude' => $request->input('latitude-input'),
				'status' => $request->input('status-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 471);

		}else{
			DB::table('bkt_01010131_pemanfaat')->insert(
       			['nik' => $request->input('nik-input'),
				'nama' => $request->input('nama-input'),
				'alamat' => $request->input('alamat-input'),
				'kode_jenis_kelamin' => $request->input('kode_jenis_kelamin-input'),
				'flag_mbr' => (int)$request->input('flag_mbr-input'),
				'longitude' => $request->input('longitude-input'),
				'latitude' => $request->input('latitude-input'),
				'status' => $request->input('status-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 470);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010131_pemanfaat')->where('kode', $request->input('kode'))->update(['status' => 2]);
        $this->log_aktivitas('Delete', 472);
        return Redirect::to('/main/data_master/pemanfaatan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 1,
			'kode_modul' => 2,
			'kode_menu' => 146,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
