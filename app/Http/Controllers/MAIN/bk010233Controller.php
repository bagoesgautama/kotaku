<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010233Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // parent::__construct();
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
				if($item->kode_menu==185)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 579);
				return view('MAIN/bk010233/index',$data);
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
			1 =>'tahun',
			2 =>'kode_kota',
			3 =>'kode_kec',
			4 =>'kode_kel',
			5 =>'tgl_kegiatan',
			6 =>'lok_kegiatan',
			7 =>'q_peserta_p',
			8 =>'q_peserta_w',
			9 =>'q_peserta_mbr'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_kec, d.nama nama_kel 
				from bkt_01020219_pra_pemilu_bkm a
				left join bkt_01010102_kota b on a.kode_kota=b.kode
				left join bkt_01010103_kec c on a.kode_kec=c.kode
				left join bkt_01010104_kel d on a.kode_kel=d.kode ';
		$totalData = DB::select('select count(1) cnt
									from bkt_01020219_pra_pemilu_bkm a
									left join bkt_01010102_kota b on a.kode_kota=b.kode
									left join bkt_01010103_kec c on a.kode_kec=c.kode
									left join bkt_01010104_kel d on a.kode_kel=d.kode');
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
			$posts=DB::select($query. ' where (
					a.kode like "%'.$search.'%" or 
					b.nama like "%'.$search.'%" or 
					c.nama like "%'.$search.'%" or
					d.nama like "%'.$search.'%" or 
					a.tgl_kegiatan like "%'.$search.'%" or
					a.lok_kegiatan like "%'.$search.'%" or 
					a.tahun like "%'.$search.'%" )
					order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					a.kode like "%'.$search.'%" or 
					b.nama like "%'.$search.'%" or 
					c.nama like "%'.$search.'%" or
					d.nama like "%'.$search.'%" or 
					a.tgl_kegiatan like "%'.$search.'%" or
					a.lok_kegiatan like "%'.$search.'%" or 
					a.tahun like "%'.$search.'%"
					)) a');
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
				//show
				$url_show="/main/persiapan/kelurahan/pemilu_bkm/persiapan/show?kode=".$edit;
				$url_edit="/main/persiapan/kelurahan/pemilu_bkm/persiapan/create?kode=".$show;
				$url_delete="/main/persiapan/kelurahan/pemilu_bkm/persiapan/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['q_peserta_p'] = $post->q_peserta_p;
				$nestedData['q_peserta_w'] = $post->q_peserta_w;
				$nestedData['q_peserta_mbr'] = $post->q_peserta_mbr;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==185)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['579'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['581'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['582'])){
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

	public function show(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==185)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['579'])){
				$rowData = DB::select('select * from bkt_01020219_pra_pemilu_bkm where kode='.$data['kode']);
				$data['detil_menu']='579';
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['tahun'] = $rowData[0]->tahun;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_peserta_mbr'] = $rowData[0]->q_peserta_mbr;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
				$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode='.$rowData[0]->kode_kec);
				$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode='.$rowData[0]->kode_kel);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010233/create',$data);
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
				if($item->kode_menu==185)
					$data['detil'][$item->kode_menu_detil]='a';
			}

			$data['username'] = '';
			$data['test']=true;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['581'])){
				$rowData = DB::select('select * from bkt_01020219_pra_pemilu_bkm where kode='.$data['kode']);
				$data['detil_menu']='581';
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['tahun'] = $rowData[0]->tahun;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_peserta_mbr'] = $rowData[0]->q_peserta_mbr;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				if(empty($user->kode_faskel) && empty($user->kode_korkot)){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				}elseif(empty($user->kode_faskel) && !empty($user->kode_korkot)){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010110_kmw b on a.kode_kmw=b.kode
															left join bkt_01010102_kota c on b.kode_prop=c.kode_prop
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				}elseif(!empty($user->kode_faskel) && !empty($user->kode_korkot)){
					$data['kode_kota_list']= DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select distinct c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010114_kel_faskel b on a.kode_faskel=b.kode_faskel
															left join bkt_01010103_kec c on b.kode_kec=c.kode
														where a.id='.$user->id);
					$data['kode_kel_list']=DB::select('select c.kode, c.nama 
														from bkt_02010111_user a 
														left join bkt_01010114_kel_faskel b on a.kode_faskel=b.kode_faskel
														left join  bkt_01010104_kel c on b.kode_kel=c.kode
														where a.id='.$user->id);
				}
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010233/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['580'])){
				$data['detil_menu']='580';
				$dataUser = DB::select('select * from bkt_02010111_user where id='.$user->id);
				$data['kode_kmw'] = $dataUser[0]->kode_kmw;
				$data['kode_korkot'] = $dataUser[0]->kode_korkot;
				$data['kode_faskel'] = $dataUser[0]->kode_faskel;
				$data['tahun'] = null;
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['q_peserta_p'] = null;
				$data['q_peserta_w'] = null;
				$data['q_peserta_mbr'] = null;
				$data['uri_img_document'] = null;
				$data['uri_img_absensi'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				if ($data['kode_korkot']!=null){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
				}elseif($data['kode_korkot']==null){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010110_kmw b on a.kode_kmw=b.kode
															left join bkt_01010102_kota c on b.kode_prop=c.kode_prop
														where a.id='.$user->id);
				}
				$data['kode_kec_list'] = null;
				$data['kode_kel_list'] = null;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010233/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function select(Request $request)
	{
		if(($request->input('kec'))!=null && ($request->input('faskel'))!=null) {
			$kec_faskel = DB::select('select distinct a.kode, a.nama
										from bkt_01010103_kec a, bkt_01010114_kel_faskel b where a.kode=b.kode_kec and b.kode_faskel='.$request->input('faskel'));
			echo json_encode($kec_faskel);
		}
		elseif(($request->input('kec'))!=null && ($request->input('faskel'))==null){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kec'));
			echo json_encode($kec);
		}
		elseif(($request->input('kel'))!=null && ($request->input('faskel'))!=null) {
			$kel_faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010104_kel b where a.kode_kel=b.kode and b.kode_kec='.$request->input('kel').' and a.kode_faskel='.$request->input('faskel'));
			echo json_encode($kel_faskel);
		}
		elseif(($request->input('kel'))!=null && ($request->input('faskel'))==null) {
			$kel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010104_kel b where a.kode_kel=b.kode and b.kode_kec='.$request->input('kel'));
			echo json_encode($kel);
		}
		elseif(!empty($request->input('faskel'))){
			$faskel = DB::select('select kode_faskel from bkt_01010114_kel_faskel where kode_kel='.$request->input('faskel'));
			echo json_encode($faskel);
		}
		elseif(!empty($request->input('korkot'))){
			$korkot = DB::select('select kode_korkot from bkt_01010112_kota_korkot where kode_kota='.$request->input('korkot'));
			echo json_encode($korkot);
		}
	}

	public function post_create(Request $request)
	{

		$file_document = $request->file('uri_img_document-input');
		$uri_document = null;
		$upload_document = false;
		if($request->input('uri_img_document-file') != null && $file_document == null){
			$uri_document = $request->input('uri_img_document-file');
			$upload_document = false;
		}elseif($request->input('uri_img_document-file') != null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}elseif($request->input('uri_img_document-file') == null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}

		$file_absensi = $request->file('uri_img_absensi-input');
		$uri_absensi = null;
		$upload_absensi = false;
		if($request->input('uri_img_absensi-file') != null && $file_absensi == null){
			$uri_absensi = $request->input('uri_img_absensi-file');
			$upload_absensi = false;
		}elseif($request->input('uri_img_absensi-file') != null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uri_img_absensi-file') == null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_01020219_pra_pemilu_bkm')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'kode_kmw' => $request->input('kode_kmw-input'),
				'kode_korkot' => $request->input('kode_korkot-input'),
				'kode_faskel' => $request->input('kode_faskel-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl_kegiatan-input')),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'q_peserta_p' => $request->input('q_peserta_p-input'),
				'q_peserta_w' => $request->input('q_peserta_w-input'),
				'q_peserta_mbr' => $request->input('q_peserta_mbr-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/pemilu_bkm/persiapan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/pemilu_bkm/persiapan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 581);

		}else{
			DB::table('bkt_01020219_pra_pemilu_bkm')->insert(
       			['tahun' => $request->input('tahun-input'),
				'kode_kmw' => $request->input('kode_kmw-input'),
				'kode_korkot' => $request->input('kode_korkot-input'),
				'kode_faskel' => $request->input('kode_faskel-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl_kegiatan-input')),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'q_peserta_p' => $request->input('q_peserta_p-input'),
				'q_peserta_w' => $request->input('q_peserta_w-input'),
				'q_peserta_mbr' => $request->input('q_peserta_mbr-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/pemilu_bkm/persiapan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/pemilu_bkm/persiapan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 580);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020219_pra_pemilu_bkm')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 582);
        return Redirect::to('/main/persiapan/kelurahan/pemilu_bkm/persiapan');
    }

    public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 185,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
