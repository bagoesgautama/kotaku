<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020304Controller extends Controller
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
				if($item->kode_menu==170)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 537);
				return view('HRM/bk020304/index',$data);
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
			1 =>'nama_lembaga',
			2 =>'fakultas',
			3 =>'bidang_studi',
			4 =>'thn_masuk',
			5 =>'thn_lulus'
		);
		$query='select * from bkt_02010110_pendidikan where kode_user='.$user->id;
		$totalData = DB::select('select count(1) cnt from bkt_02010110_pendidikan where kode_user='.$user->id);
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
				$url_edit="/hrm/profil/user/pendidikan/create?kode=".$edit;
				$url_delete="/hrm/profil/user/pendidikan/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['nama_lembaga'] = $post->nama_lembaga;
				$nestedData['fakultas'] = $post->fakultas;
				$nestedData['bidang_studi'] = $post->bidang_studi;
				$nestedData['thn_masuk'] = $post->thn_masuk;
				$nestedData['thn_lulus'] = $post->thn_lulus;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==170)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['539'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['540'])){
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
				if($item->kode_menu==170)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['539'])){
				$rowData = DB::select('select * from bkt_02010110_pendidikan where kode='.$data['kode']);
				$data['nama_lembaga'] = $rowData[0]->nama_lembaga;
				$data['fakultas'] = $rowData[0]->fakultas;
				$data['bidang_studi'] = $rowData[0]->bidang_studi;
				$data['tingkat'] = $rowData[0]->tingkat;
				$data['thn_masuk'] = $rowData[0]->thn_masuk;
				$data['thn_lulus'] = $rowData[0]->thn_lulus;
				$data['deskripsi'] = $rowData[0]->deskripsi;
				$data['uri_img_dok1'] = $rowData[0]->uri_img_dok1;
				$data['uri_img_dok2'] = $rowData[0]->uri_img_dok2;
				$data['uri_img_dok3'] = $rowData[0]->uri_img_dok3;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('HRM/bk020304/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['540'])){
				$data['nama_lembaga'] = null;
				$data['fakultas'] = null;
				$data['bidang_studi'] = null;
				$data['tingkat'] = null;
				$data['thn_masuk'] = null;
				$data['thn_lulus'] = null;
				$data['deskripsi'] = null;
				$data['uri_img_dok1'] = null;
				$data['uri_img_dok2'] = null;
				$data['uri_img_dok3'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('HRM/bk020304/create',$data);
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
		$file = $request->file('uri_img_dok1-input');
		$url = null;
		$upload = false;
		if($request->input('uri_img_dok1') != null && $file == null){
			$url = $request->input('uri_img_dok1');
			$upload = false;
		}else if($file != null){
			$url = $user->id."_".$file->getClientOriginalName();
			$upload = true;
		}
		$file2 = $request->file('uri_img_dok2-input');
		$url2 = null;
		$upload2 = false;
		if($request->input('uri_img_dok2') != null && $file2 == null){
			$url2 = $request->input('uri_img_dok2');
			$upload2 = false;
		}else if($file2 != null){
			$url2 = $user->id."_".$file2->getClientOriginalName();
			$upload2 = true;
		}
		$file3 = $request->file('uri_img_dok3-input');
		$url3 = null;
		$upload3 = false;
		if($request->input('uri_img_dok3') != null && $file3 == null){
			$url3 = $request->input('uri_img_dok3');
			$upload3 = false;
		}else if($file3 != null){
			$url3 = $user->id."_".$file3->getClientOriginalName();
			$upload3 = true;
		}
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_02010110_pendidikan')->where('kode', $request->input('kode'))
			->update(['nama_lembaga' => $request->input('nama_lembaga-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'fakultas' => $request->input('fakultas-input'),
				'bidang_studi' => $request->input('bidang_studi-input'),
				'tingkat' => $request->input('tingkat-input'),
				'thn_masuk' => $request->input('thn_masuk-input'),
				'thn_lulus' => $request->input('thn_lulus-input'),
				'uri_img_dok1' => $url,
				'uri_img_dok2' => $url2,
				'uri_img_dok3' => $url3,
				'kode_user' => $user->id,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			if($upload == true){
				$file->move(public_path('/uploads/pendidikan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/pendidikan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/pendidikan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 539);

		}else{
			DB::table('bkt_02010110_pendidikan')->insert(
       			['nama_lembaga' => $request->input('nama_lembaga-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'fakultas' => $request->input('fakultas-input'),
				'bidang_studi' => $request->input('bidang_studi-input'),
				'tingkat' => $request->input('tingkat-input'),
				'thn_masuk' => $request->input('thn_masuk-input'),
				'thn_lulus' => $request->input('thn_lulus-input'),
				'uri_img_dok1' => $url,
				'uri_img_dok2' => $url2,
				'uri_img_dok3' => $url3,
				'kode_user' => $user->id,
				'created_by' => Auth::user()->id
       			]);
			if($upload == true){
				$file->move(public_path('/uploads/pendidikan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/pendidikan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/pendidikan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 538);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02010110_pendidikan')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 540);
        return Redirect::to('/hrm/profil/user/pendidikan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 170,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
