<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010104Controller extends Controller
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
				if($item->kode_menu==23)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 24);
				return view('MAIN/bk010104/index',$data);
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
				if($item->kode_menu==23)
					$data['detil'][$item->kode_menu_detil]='a';
			}
		    $data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['kode_prop']=null;
			$data['kode_kota']=null;
			$data['kode_kota_list'] =[];
			$data['kode_kec_list'] =[];
			$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			if($data['kode']!=null && !empty($data['detil']['26'])){
				$rowData = DB::select('select * from bkt_01010104_kel where kode='.$data['kode']);
				$data['nama'] = $rowData[0]->nama;
				$data['keterangan'] = $rowData[0]->keterangan;
				$data['kode_bps'] = $rowData[0]->kode_bps;
				$data['stat_kode_bps'] = $rowData[0]->stat_kode_bps;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['status'] = $rowData[0]->status;
				$data['file'] = $rowData[0]->url_border_area;
				$data['latitude'] = $rowData[0]->latitude;
				$data['longitude'] = $rowData[0]->longitude;
				$data['luas'] = $rowData[0]->luas_wil;
				$data['tipologi_kel'] = $rowData[0]->tipologi_kel;
				$data['kategori_kel'] = $rowData[0]->kategori_kel;
				if(!empty($rowData[0]->kode_kec)){
					$data['kode_kota']=DB::select('select kode_kota from bkt_01010103_kec where status=1 and kode='.$rowData[0]->kode_kec);
					$data['kode_kota']=$data['kode_kota'][0]->kode_kota;
					$data['kode_prop']=DB::select('select kode_prop from bkt_01010102_kota where status=1 and kode='.$data['kode_kota']);
					$data['kode_prop']=$data['kode_prop'][0]->kode_prop;
					$data['kode_kota_list'] =DB::select('select kode, nama from bkt_01010102_kota where status=1 and kode_prop='.$data['kode_prop']);
					$data['kode_kec_list'] =DB::select('select kode, nama from bkt_01010103_kec where status=1 and kode_kota='.$data['kode_kota']);
				}
				return view('MAIN/bk010104/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['25'])){
				$data['nama'] = null;
				$data['keterangan'] = null;
				$data['kode_bps'] = null;
				$data['stat_kode_bps'] = null;
				$data['kode_kec'] = null;
				$data['status'] = null;
				$data['file'] = null;
				$data['latitude'] = null;
				$data['longitude'] = null;
				$data['luas'] = null;
				$data['tipologi_kel'] = null;
				$data['kategori_kel'] = null;
				return view('MAIN/bk010104/create',$data);
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
			$json_file['properties']['KELURAHAN'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
			file_put_contents($file, $new_String);
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01010104_kel')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'),
			'keterangan' => $request->input('keterangan-input'),
			'kode_bps' => $request->input('kode-bps-input'),
			'stat_kode_bps' => $request->input('stat-kode-bps-input'),
			'kode_kec' => $request->input('kode-kec-input'),
			'url_border_area' => $url,
			'status' => $request->input('status-input'),
			'latitude' => $request->input('latitude-input'),
			'longitude' => $request->input('longitude-input'),
			'luas_wil' => $request->input('luas-input'),
			'tipologi_kel' => $request->input('tipologi_kel-input'),
			'kategori_kel' => $request->input('kategori_kel-input'),
			'updated_by' => Auth::user()->id,
			'updated_time' => date('Y-m-d H:i:s')]);

			if($upload == true){
				$file->move(public_path('/uploads/kelurahan'), $file->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 26);
		}else{
			DB::table('bkt_01010104_kel')->insert(
       			['nama' => $request->input('nama-input'),
				'keterangan' => $request->input('keterangan-input'),
				'kode_bps' => $request->input('kode-bps-input'),
				'stat_kode_bps' => $request->input('stat-kode-bps-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'url_border_area' => $url,
				'status' => $request->input('status-input'),
				'latitude' => $request->input('latitude-input'),
				'longitude' => $request->input('longitude-input'),
				'luas_wil' => $request->input('luas-input'),
				'tipologi_kel' => $request->input('tipologi_kel-input'),
				'kategori_kel' => $request->input('kategori_kel-input'),
				'created_by' => Auth::user()->id]);
			if($upload == true){
				$file->move(public_path('/uploads/kelurahan'), $file->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 25);
		}
	}

	public function Post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==23)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'kode',
					1 =>'prop',
					2 =>'kota',
					3 =>'kec',
					4 =>'nama',
					5 =>'status'
				);
				$query='select a.kode, a.nama, b.nama as kec, a.status,c.nama kota,d.nama prop
					from bkt_01010104_kel a,bkt_01010103_kec b, bkt_01010102_kota c,bkt_01010101_prop d
					where a.status !=2
					and a.kode_kec=b.kode
					and b.kode_kota=c.kode
					and c.kode_prop=d.kode';
				$totalData = DB::select('select count(1) cnt from bkt_01010104_kel where bkt_01010104_kel.status = 0 or bkt_01010104_kel.status = 1');
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
						$url_edit="/main/data_wilayah/kelurahan/create?kode=".$show;
						$url_delete="/main/data_wilayah/kelurahan/delete?kode=".$delete;
						$nestedData['kode'] = $post->kode;
						$nestedData['prop'] = $post->prop;
						$nestedData['kota'] = $post->kota;
						$nestedData['kec'] = $post->kec;
						$nestedData['nama'] = $post->nama;
						$nestedData['status'] = $status;
						$nestedData['option'] = "";
						if(!empty($data2['detil']['26']))
							$nestedData['option'] .="&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['27']))
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
		DB::table('bkt_01010104_kel')->where('kode', $request->input('kode'))->update(['status' => 2]);
		$this->log_aktivitas('Delete', 27);
        return Redirect::to('/main/data_wilayah/kelurahan');
    }

	public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 1,
			'kode_modul' => 2,
			'kode_menu' => 23,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
