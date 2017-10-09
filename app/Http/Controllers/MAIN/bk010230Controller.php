<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010230Controller extends Controller
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
				if($item->kode_menu==20)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				return view('MAIN/bk010101/index',$data);
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
				if($item->kode_menu==20)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			    $data['username'] = $user->name;
				$data['kode']=$request->input('kode');
				if($data['kode']!=null && !empty($data['detil']['5'])){
					$rowData = DB::select('select * from bkt_01010101_prop where kode='.$data['kode']);
					$data['nama'] = $rowData[0]->nama;
					$data['nama_pendek'] = $rowData[0]->nama_pendek;
					$data['wilayah'] = $rowData[0]->wilayah;
					$data['status'] = $rowData[0]->status;
					$data['file'] = $rowData[0]->url_border_area;
					$data['latitude'] = $rowData[0]->latitude;
					$data['longitude'] = $rowData[0]->longitude;
					return view('MAIN/bk010101/create',$data);
				}else if($data['kode']==null && !empty($data['detil']['4'])){
					$data['nama'] = null;
					$data['nama_pendek'] = null;
					$data['wilayah'] = null;
					$data['status'] = null;
					$data['file'] = null;
					$data['latitude'] = null;
					$data['longitude'] = null;
					return view('MAIN/bk010101/create',$data);
				}else {
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

		if($upload == false){
			$file = public_path('/uploads/provinsi/'.$url);
			$string = file_get_contents($file);
			$json_file = json_decode($string, true);
			$json_file['properties']['PROPINSI'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
		}elseif($upload == true){
			$string = file_get_contents($file);
			$json_file = json_decode($string, true);
			$json_file['properties']['PROPINSI'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
		}
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01010101_prop')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'), 'nama_pendek' => $request->input('nama-pndk-input'), 'wilayah' => $request->input('wilayah-input'), 'url_border_area' => $url, 'status' => $request->input('status-input'), 'latitude' => $request->input('latitude-input'), 'longitude' => $request->input('longitude-input'), 'updated_by' => Auth::user()->id, 'updated_time' => date('Y-m-d H:i:s')]);
		}else{
			DB::table('bkt_01010101_prop')->insert(
       			['nama' => $request->input('nama-input'), 'nama_pendek' => $request->input('nama-pndk-input'), 'wilayah' => $request->input('wilayah-input'), 'url_border_area' => $url, 'latitude' => $request->input('latitude-input'), 'longitude' => $request->input('longitude-input'), 'created_by' => Auth::user()->id]);
		}
	}

	public function Post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==20)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'nama',
					1 =>'nama_pendek',
					2 =>'wilayah',
					3 =>'status'
				);
				$query='select * from bkt_01010101_prop where status = 0 or status = 1 ';
				$totalData = DB::select('select count(1) cnt from bkt_01010101_prop where status = 0 or status = 1');
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
					$posts=DB::select($query. 'and nama like "%'.$search.'%" or nama_pendek like "%'.$search.'%" or wilayah like "%'.$search.'%" or status like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) from ('.$query. 'and nama like "%'.$search.'%" or nama_pendek like "%'.$search.'%" or wilayah like "%'.$search.'%" or status like "%'.$search.'%") a');
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

						$url_edit="/main/data_wilayah/provinsi/create?kode=".$show;
						$url_delete="/main/data_wilayah/provinsi/delete?kode=".$delete;
						$nestedData['nama'] = $post->nama;
						$nestedData['nama_pendek'] = $post->nama_pendek;
						$nestedData['wilayah'] = $post->wilayah;
						$nestedData['status'] = $status;
						$nestedData['option'] = "";
						if(!empty($data2['detil']['5']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['6']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
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
		DB::table('bkt_01010101_prop')->where('kode', $request->input('kode'))->update(['status' => 2]);
        return Redirect::to('/main/data_wilayah/provinsi');
    }
}
