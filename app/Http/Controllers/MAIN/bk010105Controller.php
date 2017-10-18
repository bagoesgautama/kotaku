<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010105Controller extends Controller
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
				if($item->kode_menu==147)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 473);
				return view('MAIN/bk010105/index',$data);
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
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==147)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'id',
					1 =>'prop',
					2 =>'kota',
					3 =>'kec',
					4 =>'kel',
					5 =>'kode_rt',
					6 =>'nama',
					7 =>'status'
				);
				$query='select a.id, a.kode_rt,a.nama, b.nama as kel,c.nama as kec, a.status,d.nama kota,e.nama prop
					from bkt_01010116_rt a,bkt_01010104_kel b,bkt_01010103_kec c, bkt_01010102_kota d,bkt_01010101_prop e
					where a.status !=2
					and a.kode_kel=b.kode
					and b.kode_kec=c.kode
					and c.kode_kota=d.kode
					and d.kode_prop=e.kode';
				$totalData = DB::select('select count(1) cnt from bkt_01010116_rt where bkt_01010116_rt.status = 0 or bkt_01010116_rt.status = 1');
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
					$posts=DB::select($query.' and (a.nama like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) cnt from ('.$query.' and (a.nama like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%")) a');
					$totalFiltered=$totalFiltered[0]->cnt;
				}

				$data = array();
				if(!empty($posts))
				{
					foreach ($posts as $post)
					{
						$show =  $post->id;
						$edit =  $post->id;
						$delete = $post->id;
						$status = null;
						if($post->status == 0){
							$status = 'Tidak Aktif';
						}elseif($post->status == 1){
							$status = 'Aktif';
						}elseif($post->status == 2){
							$status = 'Dihapus';
						}
						$url_edit="/main/data_wilayah/rt/create?kode=".$show;
						$url_delete="/main/data_wilayah/rt/delete?kode=".$delete;
						$nestedData['id'] = $post->id;
						$nestedData['prop'] = $post->prop;
						$nestedData['kota'] = $post->kota;
						$nestedData['kec'] = $post->kec;
						$nestedData['kel'] = $post->kel;
						$nestedData['kode_rt'] = $post->kode_rt;
						$nestedData['nama'] = $post->nama;
						$nestedData['status'] = $status;
						$nestedData['option'] = "";
						if(!empty($data2['detil']['475']))
							$nestedData['option'] .="&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['476']))
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

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==147)
					$data['detil'][$item->kode_menu_detil]='a';
			}
		    $data['username'] = $user->name;
			$data['id']=$request->input('kode');
			$data['kode_prop']=null;
			$data['kode_kota']=null;
			$data['kode_kec']=null;
			$data['kode_kota_list'] =[];
			$data['kode_kec_list'] =[];
			$data['kode_kel_list'] =[];
			$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			if($data['id']!=null && !empty($data['detil']['475'])){
				$rowData = DB::select('select * from bkt_01010116_rt where id='.$data['id']);
				$data['nama'] = $rowData[0]->nama;
				$data['kode_rt'] = $rowData[0]->kode_rt;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['status'] = $rowData[0]->status;
				$data['latitude'] = $rowData[0]->latitude;
				$data['longitude'] = $rowData[0]->longitude;
				$data['luas'] = $rowData[0]->luas_wil;
				$data['id_rw'] = $rowData[0]->id_rw;
				$data['deskripsi'] = $rowData[0]->deskripsi;
				if(!empty($rowData[0]->kode_kel)){
					$data['kode_kec']=DB::select('select kode_kec from bkt_01010104_kel where status=1 and kode='.$rowData[0]->kode_kel);
					$data['kode_kec']=$data['kode_kec'][0]->kode_kec;
					$data['kode_kota']=DB::select('select kode_kota from bkt_01010103_kec where status=1 and kode='.$data['kode_kec']);
					$data['kode_kota']=$data['kode_kota'][0]->kode_kota;
					$data['kode_prop']=DB::select('select kode_prop from bkt_01010102_kota where status=1 and kode='.$data['kode_kota']);
					$data['kode_prop']=$data['kode_prop'][0]->kode_prop;
					$data['kode_kota_list'] =DB::select('select kode, nama from bkt_01010102_kota where status=1 and kode_prop='.$data['kode_prop']);
					$data['kode_kec_list'] =DB::select('select kode, nama from bkt_01010103_kec where status=1 and kode_kota='.$data['kode_kota']);
					$data['kode_kel_list'] =DB::select('select kode, nama from bkt_01010104_kel where status=1 and kode_kec='.$data['kode_kec']);
				}
				return view('MAIN/bk010105/create',$data);
			}else if($data['id']==null && !empty($data['detil']['474'])){
				$data['nama'] = null;
				$data['kode_rt'] = null;
				$data['kode_kel'] = null;
				$data['status'] = null;
				$data['latitude'] = null;
				$data['longitude'] = null;
				$data['luas'] = null;
				$data['id_rw'] = null;
				$data['deskripsi'] = null;
				return view('MAIN/bk010105/create',$data);
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
		/*$file = $request->file('file-input');
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
			$json_file['properties']['KELURAHAN'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
			file_put_contents($file, $new_String);
		}*/

		if ($request->input('id')!=null){
			date_default_timezone_set('Asia/Jakarta');

			DB::table('bkt_01010116_rt')->where('id', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'),
			'deskripsi' => $request->input('deskripsi-input'),
			'kode_rt' => $request->input('kode_rt-input'),
			'id_rw' => $request->input('id_rw-input'),
			'kode_kel' => $request->input('kode-kel-input'),
			//'url_border_area' => $url,
			'status' => $request->input('status-input'),
			'latitude' => $request->input('latitude-input'),
			'longitude' => $request->input('longitude-input'),
			'luas_wil' => $request->input('luas-input'),
			'updated_by' => Auth::user()->id,
			'updated_time' => date('Y-m-d H:i:s')]);

			/*if($upload == true){
				$file->move(public_path('/uploads/kelurahan'), $file->getClientOriginalName());
			}*/
			$this->log_aktivitas('Update', 475);
		}else{
			DB::table('bkt_01010116_rt')->insert(
       			['nama' => $request->input('nama-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'kode_rt' => $request->input('kode_rt-input'),
				'id_rw' => $request->input('id_rw-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				//'url_border_area' => $url,
				'status' => $request->input('status-input'),
				'latitude' => $request->input('latitude-input'),
				'longitude' => $request->input('longitude-input'),
				'luas_wil' => $request->input('luas-input'),
				'created_by' => Auth::user()->id]);
			/*if($upload == true){
				$file->move(public_path('/uploads/kelurahan'), $file->getClientOriginalName());
			}*/
			$this->log_aktivitas('Create', 474);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010116_rt')->where('kode', $request->input('kode'))->update(['status' => 2]);
		$this->log_aktivitas('Delete', 476);
        return Redirect::to('/main/data_wilayah/rt');
    }

	public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 1,
			'kode_modul' => 2,
			'kode_menu' => 147,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
