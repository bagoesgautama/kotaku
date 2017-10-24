<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010102Controller extends Controller
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
				if($item->kode_menu==21)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 7);
				return view('MAIN/bk010102/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==21)
					$data['detil'][$item->kode_menu_detil]='a';
			}
		    $data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			if($data['kode']!=null && !empty($data['detil']['9'])){
				$rowData = DB::select('select * from bkt_01010102_kota where kode='.$data['kode']);
				$data['nama'] = $rowData[0]->nama;
				$data['nama_pendek'] = $rowData[0]->nama_pendek;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['status'] = $rowData[0]->status;
				$data['file'] = $rowData[0]->url_border_area;
				$data['latitude'] = $rowData[0]->latitude;
				$data['longitude'] = $rowData[0]->longitude;
				$data['luas'] = $rowData[0]->luas_wil;
				$data['kode_bps'] = $rowData[0]->kode_bps;
				return view('MAIN/bk010102/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['8'])){
				$data['nama'] = null;
				$data['nama_pendek'] = null;
				$data['kode_prop'] = null;
				$data['status'] = null;
				$data['file'] = null;
				$data['latitude'] = null;
				$data['longitude'] = null;
				$data['luas'] = null;
				$data['kode_bps'] = null;
				return view('MAIN/bk010102/create',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$file = $request->file('file-input');
		$url = null;
		$upload = false;
		if($request->input('uploaded-file') != null && $file == null){
			$url = $request->input('uploaded-file');
			$upload = false;
		}elseif($request->input('uploaded-file') != null && $file != null){
			$url = $file->getClientOriginalName();
			$upload = true;
		}elseif($request->input('uploaded-file') == null && $file != null){
			$url = $file->getClientOriginalName();
			$upload = true;
		}

		if($upload == true){
			$string = file_get_contents($file);
			$json_file = json_decode($string, true);
			$json_file['properties']['KOTA'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
			file_put_contents($file, $new_String);
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01010102_kota')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'),
				'nama_pendek' => $request->input('nama-pndk-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'url_border_area' => $url,
				'status' => $request->input('status-input'),
				'latitude' => $request->input('latitude-input'),
				'longitude' => $request->input('longitude-input'),
				'luas_wil' => $request->input('luas-input'),
				'kode_bps' => $request->input('kode_bps-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')]);
			if($upload == true){
				$file->move(public_path('/uploads/kota'), $file->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 9);
		}else{
			DB::table('bkt_01010102_kota')->insert(
       			['nama' => $request->input('nama-input'),
				'nama_pendek' => $request->input('nama-pndk-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'status' => $request->input('status-input'),
				'url_border_area' => $url,
				'latitude' => $request->input('latitude-input'),
				'longitude' => $request->input('longitude-input'),
				'luas_wil' => $request->input('luas-input'),
				'kode_bps' => $request->input('kode_bps-input'),
				'created_by' => Auth::user()->id]);
			if($upload == true){
				$file->move(public_path('/uploads/kota'), $file->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 8);
		}
	}

	public function Post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==21)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'kode',
					1 =>'prop',
					2 =>'nama',
					3 =>'nama_pendek',
					4 =>'status'
				);
				$query='select bkt_01010101_prop.nama prop,bkt_01010102_kota.kode, bkt_01010102_kota.nama, bkt_01010102_kota.nama_pendek, bkt_01010101_prop.nama as kode_prop, bkt_01010102_kota.status, bkt_01010102_kota.created_time from bkt_01010102_kota inner join bkt_01010101_prop on bkt_01010102_kota.kode_prop = bkt_01010101_prop.kode where bkt_01010102_kota.status = 0 or bkt_01010102_kota.status = 1';
				$totalData = DB::select('select count(1) cnt from bkt_01010102_kota  where bkt_01010102_kota.status = 0 or bkt_01010102_kota.status = 1');
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
					$posts=DB::select($query.' and bkt_01010102_kota.nama like "%'.$search.'%" or bkt_01010102_kota.nama_pendek like "%'.$search.'%" or bkt_01010101_prop.nama like "%'.$search.'%" or bkt_01010102_kota.status like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) cnt from ('.$query.' and bkt_01010102_kota.nama like "%'.$search.'%" or bkt_01010102_kota.nama_pendek like "%'.$search.'%" or bkt_01010101_prop.nama like "%'.$search.'%" or bkt_01010102_kota.status like "%'.$search.'%") a');
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
						$status = null;
						if($post->status == 0){
							$status = 'Tidak Aktif';
						}elseif($post->status == 1){
							$status = 'Aktif';
						}elseif($post->status == 2){
							$status = 'Dihapus';
						}
						$url_edit="/main/data_wilayah/kota/create?kode=".$show;
						$url_delete="/main/data_wilayah/kota/delete?kode=".$delete;
						$nestedData['kode'] = $post->kode;
						$nestedData['nama'] = $post->nama;
						$nestedData['nama_pendek'] = $post->nama_pendek;
						$nestedData['prop'] = $post->prop;
						$nestedData['status'] = $status;
						$nestedData['option'] = "";
						if(!empty($data2['detil']['9']))
							$nestedData['option'] .="&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['10']))
							$nestedData['option'] .="&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
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
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010102_kota')->where('kode', $request->input('kode'))->update(['status' => 2]);
		$this->log_aktivitas('Delete', 10);
        return Redirect::to('/main/data_wilayah/kota');
    }

	public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 1,
			'kode_modul' => 2,
			'kode_menu' => 21,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
