<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020303Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==169)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 533);
				return view('HRM/bk020303/index',$data);
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
		$user = Auth::user();
		$columns = array(
			0 =>'kode',
			1 =>'nama',
			2 =>'tgl_pelatihan',
			3 =>'instansi'
		);
		$query='select * from bkt_02030202_pelatihan where kode_user='.$user->id;
		$totalData = DB::select('select count(1) cnt from bkt_02030202_pelatihan where kode_user='.$user->id);
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
			$posts=DB::select($query. ' and d.nama like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and d.nama like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->kode;
				$url_edit="/hrm/management/user/pelatihan/create?kode=".$edit;
				$url_delete="/hrm/management/user/pelatihan/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['tgl_pelatihan'] = $post->tgl_pelatihan;
				$nestedData['nama'] = $post->nama;
				$nestedData['instansi'] = $post->instansi;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==169)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['535'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['536'])){
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==169)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['535'])){
				$rowData = DB::select('select * from bkt_02030202_pelatihan where kode='.$data['kode']);
				$data['nama'] = $rowData[0]->nama;
				$data['deskripsi'] = $rowData[0]->deskripsi;
				$data['tgl_pelatihan'] = $rowData[0]->tgl_pelatihan;
				$data['instansi'] = $rowData[0]->instansi;
				$data['uri_img_sertifikat1'] = $rowData[0]->uri_img_sertifikat1;
				$data['uri_img_sertifikat2'] = $rowData[0]->uri_img_sertifikat2;
				$data['url_img_sertifikat3'] = $rowData[0]->url_img_sertifikat3;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('HRM/bk020303/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['534'])){
				$data['nama'] = null;
				$data['deskripsi'] = null;
				$data['tgl_pelatihan'] = null;
				$data['instansi'] = null;
				$data['uri_img_sertifikat1'] = null;
				$data['uri_img_sertifikat2'] = null;
				$data['url_img_sertifikat3'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('HRM/bk020303/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$user = Auth::user();
		$file = $request->file('uri_img_sertifikat1-input');
		$url = null;
		$upload = false;
		if($request->input('uri_img_sertifikat1') != null && $file == null){
			$url = $request->input('uri_img_sertifikat1');
			$upload = false;
		}else if($file != null){
			$url = $user->id."_".$file->getClientOriginalName();
			$upload = true;
		}
		$file2 = $request->file('uri_img_sertifikat2-input');
		$url2 = null;
		$upload2 = false;
		if($request->input('uri_img_sertifikat2') != null && $file2 == null){
			$url2 = $request->input('uri_img_sertifikat2');
			$upload2 = false;
		}else if($file2 != null){
			$url2 = $user->id."_".$file2->getClientOriginalName();
			$upload2 = true;
		}
		$file3 = $request->file('url_img_sertifikat3-input');
		$url3 = null;
		$upload3 = false;
		if($request->input('url_img_sertifikat3') != null && $file3 == null){
			$url3 = $request->input('url_img_sertifikat3');
			$upload3 = false;
		}else if($file3 != null){
			$url3 = $user->id."_".$file3->getClientOriginalName();
			$upload3 = true;
		}
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_02030202_pelatihan')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'tgl_pelatihan' => $request->input('tgl_pelatihan-input'),
				'instansi' => $request->input('instansi-input'),
				'uri_img_sertifikat1' => $url,
				'uri_img_sertifikat2' => $url2,
				'url_img_sertifikat3' => $url3,
				'kode_user' => $user->id,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			if($upload == true){
				$file->move(public_path('/uploads/pelatihan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/pelatihan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/pelatihan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 535);

		}else{
			DB::table('bkt_02030202_pelatihan')->insert(
       			['nama' => $request->input('nama-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'tgl_pelatihan' => $request->input('tgl_pelatihan-input'),
				'instansi' => $request->input('instansi-input'),
				'uri_img_sertifikat1' => $url,
				'uri_img_sertifikat2' => $url2,
				'url_img_sertifikat3' => $url3,
				'kode_user' => $user->id,
				'created_by' => Auth::user()->id
       			]);
			if($upload == true){
				$file->move(public_path('/uploads/pelatihan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/pelatihan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/pelatihan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 534);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02030202_pelatihan')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 536);
        return Redirect::to('/hrm/management/user/pelatihan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 169,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
