<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020305Controller extends Controller
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
				if($item->kode_menu==202)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 629);
				return view('HRM/bk020305/index',$data);
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
			2 =>'tgl_penghargaan',
            3 =>'flag_kotaku',
            4 =>'instansi'
		);
		$query='select * from bkt_02030203_penghargaan where kode_user='.$user->id;
		$totalData = DB::select('select count(1) cnt from bkt_02030203_penghargaan where kode_user='.$user->id);
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
			$posts=DB::select($query. ' and CONCAT(kode, nama, instansi, tgl_penghargaan) like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and CONCAT(kode, nama, instansi, tgl_penghargaan) like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->kode;
				$url_edit="/hrm/profil/penghargaan/create?kode=".$edit;
				$url_delete="/hrm/profil/penghargaan/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['nama'] = $post->nama;
				$nestedData['instansi'] = $post->instansi;
				$nestedData['tgl_penghargaan'] = $post->tgl_penghargaan;
				$nestedData['flag_kotaku'] = $post->flag_kotaku;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==202)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['631'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['632'])){
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
				if($item->kode_menu==202)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['631'])){
				$rowData = DB::select('select * from bkt_02030203_penghargaan where kode='.$data['kode']);
				$data['nama'] = $rowData[0]->nama;
				$data['tgl_penghargaan'] = $rowData[0]->tgl_penghargaan;
                $data['flag_kotaku'] = $rowData[0]->flag_kotaku;
				$data['instansi'] = $rowData[0]->instansi;
				$data['deskripsi'] = $rowData[0]->deskripsi;
				$data['uri_img_sertifikat1'] = $rowData[0]->uri_img_sertifikat1;
				$data['uri_img_sertifikat2'] = $rowData[0]->uri_img_sertifikat2;
				$data['uri_img_sertifikat3'] = $rowData[0]->uri_img_sertifikat3;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('HRM/bk020305/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['630'])){
				$data['nama'] = null;
				$data['tgl_penghargaan'] = null;
                $data['flag_kotaku'] = null;
				$data['instansi'] = null;
				$data['deskripsi'] = null;
				$data['uri_img_sertifikat1'] = null;
				$data['uri_img_sertifikat2'] = null;
				$data['uri_img_sertifikat3'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('HRM/bk020305/create',$data);
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
		if($request->input('uri_img_sertifikat1-file') != null && $file == null){
			$url = $request->input('uri_img_sertifikat1-file');
			$upload = false;
		}else if($file != null){
			$url = $user->id."_".$file->getClientOriginalName();
			$upload = true;
		}
		$file2 = $request->file('uri_img_sertifikat2-input');
		$url2 = null;
		$upload2 = false;
		if($request->input('uri_img_sertifikat2-file') != null && $file2 == null){
			$url2 = $request->input('uri_img_sertifikat2-file');
			$upload2 = false;
		}else if($file2 != null){
			$url2 = $user->id."_".$file2->getClientOriginalName();
			$upload2 = true;
		}
		$file3 = $request->file('uri_img_sertifikat3-input');
		$url3 = null;
		$upload3 = false;
		if($request->input('uri_img_sertifikat3-file') != null && $file3 == null){
			$url3 = $request->input('uri_img_sertifikat3-file');
			$upload3 = false;
		}else if($file3 != null){
			$url3 = $user->id."_".$file3->getClientOriginalName();
			$upload3 = true;
		}
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_02030203_penghargaan')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'tgl_penghargaan' => $request->input('tgl_penghargaan-input'),
                'flag_kotaku' => DB::raw($request->input('flag_kotaku')),
				'instansi' => $request->input('instansi-input'),
				'uri_img_sertifikat1' => $url,
				'uri_img_sertifikat2' => $url2,
				'uri_img_sertifikat3' => $url3,
				'kode_user' => $user->id,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			if($upload == true){
				$file->move(public_path('/uploads/penghargaan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/penghargaan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/penghargaan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 631);

		}else{
			DB::table('bkt_02030203_penghargaan')->insert(
       			['nama' => $request->input('nama-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'tgl_penghargaan' => $request->input('tgl_penghargaan-input'),
                'flag_kotaku' => DB::raw($request->input('flag_kotaku')),
				'instansi' => $request->input('instansi-input'),
				'uri_img_sertifikat1' => $url,
				'uri_img_sertifikat2' => $url2,
				'uri_img_sertifikat3' => $url3,
				'kode_user' => $user->id,
				'created_by' => Auth::user()->id
       			]);
			if($upload == true){
				$file->move(public_path('/uploads/penghargaan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/penghargaan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/penghargaan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 630);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02030203_penghargaan')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 632);
        return Redirect::to('/hrm/profil/penghargaan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 16,
			'kode_menu' => 202,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
