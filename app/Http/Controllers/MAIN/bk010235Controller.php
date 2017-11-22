<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010235Controller extends Controller
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
				if($item->kode_menu==188)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 587);
				return view('MAIN/bk010235/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

    public function select(Request $request)
	{
		if($request->input('kode_pemilu')!=null) {
			$bkm = DB::select('select 
					a.* ,
					b.id id_bkm,
					b.nama nama_bkm
				from bkt_01020214_pemilu_bkm a
					left join bkt_01010125_bkm b on a.kode_kel=b.kode_kel
				where 
					a.kode='.$request->input('kode_pemilu'));
			echo json_encode($bkm);
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
			7 =>'q_terpilih_p',
			8 =>'q_terpilih_w',
			9 =>'q_terpilih_mbr'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kec, e.nama nama_kmw, f.nama nama_kel, g.nama nama_faskel
				from bkt_01020214_pemilu_bkm a
				left join bkt_01010102_kota b on a.kode_kota=b.kode
				left join bkt_01010111_korkot c on a.kode_korkot=c.kode
				left join bkt_01010103_kec d on a.kode_kec=d.kode
				left join bkt_01010110_kmw e on a.kode_kmw=e.kode
				left join bkt_01010104_kel f on a.kode_kel=f.kode
				left join bkt_01010113_faskel g on a.kode_faskel=g.kode';
		$totalData = DB::select('select count(1) cnt
									from bkt_01020214_pemilu_bkm a
									left join bkt_01010102_kota b on a.kode_kota=b.kode
									left join bkt_01010111_korkot c on a.kode_korkot=c.kode
									left join bkt_01010103_kec d on a.kode_kec=d.kode
									left join bkt_01010110_kmw e on a.kode_kmw=e.kode
									left join bkt_01010104_kel f on a.kode_kel=f.kode
									left join bkt_01010113_faskel g on a.kode_faskel=g.kode');
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
				$url_show=url('/')."/main/persiapan/kelurahan/pemilu_bkm/data/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/kelurahan/pemilu_bkm/data/create?kode=".$show;
				// $url_delete=url('/')."/main/persiapan/kelurahan/pemilu_bkm/data/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kel'] = $post->nama_kec;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['q_terpilih_p'] = $post->q_terpilih_p;
				$nestedData['q_terpilih_w'] = $post->q_terpilih_w;
				$nestedData['q_terpilih_mbr'] = $post->q_terpilih_mbr;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==188)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				$tambah_anggota = '';
				if(!empty($detil['587'])){
					$option .= "<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['589'])){
					$tambah_anggota .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				// if(!empty($detil['590'])){
				// 	$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				// }
				$nestedData['tambah_anggota'] = $tambah_anggota;
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

	public function Anggota_post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'nama',
			2 =>'jenis_kelamin',
			3 =>'status_sosial',
			4 =>'nama_pendidikan',
			5 =>'nama_pekerjaan',
			6 =>'jml_dukungan'
		);
		$query='
			select * from(select 
				a.*, 
				a.nama nama_anggota,
				case when a.status_sosial="0" then "Miskin dan Rentan" when status_sosial="1" then "Non Miskin" end status_sosial_convert,
				b.nama nama_pendidikan,
				c.nama nama_pekerjaan
			from bkt_01010133_anggt_bkm a
				left join bkt_01010135_tkt_pendidikan b on b.kode=a.kode_pendidikan
				left join bkt_01010134_pekerjaan c on c.kode=a.kode_pekerjaan
			where 
				a.status!=2 and
				a.kode_bkm='.$request->input('kode_bkm').') b';
		$totalData = DB::select('select count(1) cnt from bkt_01010133_anggt_bkm a
				left join bkt_01010135_tkt_pendidikan b on b.kode=a.kode_pendidikan
				left join bkt_01010134_pekerjaan c on c.kode=a.kode_pekerjaan
			where 
				a.status!=2 and
				a.kode_bkm='.$request->input('kode_bkm'));
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
			$posts=DB::select($query. ' where (b.nama_anggota like "%'.$search.'%" or b.status_sosial_convert like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (b.nama_anggota like "%'.$search.'%" or b.status_sosial_convert like "%'.$search.'%")) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$delete = $post->kode;
				$url_edit="/main/persiapan/kelurahan/pemilu_bkm/data/anggota/create?kode_anggota=".$show.'&kode='.$request->input('kode');
				$url_delete="/main/persiapan/kelurahan/pemilu_bkm/data/anggota/delete?kode_anggota=".$delete.'&kode_bkm='.$post->kode_bkm.'&kode_pemilu='.$request->input('kode_pemilu');
				$nestedData['kode'] = $post->kode;
				// $nestedData['kode_bkm'] = $post->kode_bkm;
				$nestedData['nama'] = $post->nama_anggota;
				$nestedData['jenis_kelamin'] = $post->jenis_kelamin;
				$nestedData['status_sosial'] = $post->status_sosial_convert;
				$nestedData['nama_pendidikan'] = $post->nama_pendidikan;
				$nestedData['nama_pekerjaan'] = $post->nama_pekerjaan;
				$nestedData['jml_dukungan'] = $post->jml_dukungan;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==188)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['589']) && $request->input('detil_menu')=='589'){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['589']) && $request->input('detil_menu')=='589'){
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
				if($item->kode_menu==188)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['587'])){
				$rowData = DB::select('select 
					a.* ,
					b.id id_bkm,
					b.nama nama_bkm
				from bkt_01020214_pemilu_bkm a
					left join bkt_01010125_bkm b on a.kode_kel=b.kode_kel where kode='.$data['kode']);
				$data['detil_menu']='587';
				$data['bkm'] = $rowData[0]->nama_bkm;
				$data['kode_pemilu'] = $rowData[0]->kode;
				$data['kode_bkm'] = $rowData[0]->id_bkm;

				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;

				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_terpilih_p'] = $rowData[0]->q_terpilih_p;
				$data['q_terpilih_w'] = $rowData[0]->q_terpilih_w;
				$data['q_terpilih_mbr'] = $rowData[0]->q_terpilih_mbr;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['diser_tgl'] = $rowData[0]->diser_tgl;
				$data['diser_oleh'] = $rowData[0]->diser_oleh;
				$data['diket_tgl'] = $rowData[0]->diser_tgl;
				$data['diket_oleh'] = $rowData[0]->diser_oleh;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh			;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
				$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode='.$rowData[0]->kode_kec);
				$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode='.$rowData[0]->kode_kel);
				$data['kode_pemilu_bkm_list']=DB::select('select 
					a.* ,
					c.nama nama_kel,
					b.id id_bkm
				from bkt_01020214_pemilu_bkm a
					left join bkt_01010125_bkm b on a.kode_kel=b.kode_kel
					left join bkt_01010104_kel c on c.kode=a.kode_kel
				where 
					a.kode_kel='.$rowData[0]->kode_kel);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010235/create',$data);
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
				if($item->kode_menu==188)
					$data['detil'][$item->kode_menu_detil]='a';
			}

			$data['username'] = '';
			$data['test']=true;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['589'])){
				$data['detil_menu']='589';
				$rowData = DB::select('select 
					a.* ,
					b.id id_bkm,
					b.nama nama_bkm
				from bkt_01020214_pemilu_bkm a
					left join bkt_01010125_bkm b on a.kode_kel=b.kode_kel where kode='.$data['kode']);
				$data['detil_menu']='589';
				$data['bkm'] = $rowData[0]->nama_bkm;
				$data['kode_pemilu'] = $rowData[0]->kode;
				$data['kode_bkm'] = $rowData[0]->id_bkm;

				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;

				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_terpilih_p'] = $rowData[0]->q_terpilih_p;
				$data['q_terpilih_w'] = $rowData[0]->q_terpilih_w;
				$data['q_terpilih_mbr'] = $rowData[0]->q_terpilih_mbr;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['diser_tgl'] = $rowData[0]->diser_tgl;
				$data['diser_oleh'] = $rowData[0]->diser_oleh;
				$data['diket_tgl'] = $rowData[0]->diser_tgl;
				$data['diket_oleh'] = $rowData[0]->diser_oleh;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh			;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
				$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode='.$rowData[0]->kode_kec);
				$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode='.$rowData[0]->kode_kel);
				$data['kode_pemilu_bkm_list']=DB::select('select 
					a.* ,
					c.nama nama_kel,
					b.id id_bkm
				from bkt_01020214_pemilu_bkm a
					left join bkt_01010125_bkm b on a.kode_kel=b.kode_kel
					left join bkt_01010104_kel c on c.kode=a.kode_kel
				where 
					a.kode_kel='.$rowData[0]->kode_kel);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010235/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function anggota_create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==188)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['kode_bkm']=$request->input('kode_bkm');
			$data['kode_anggota']=$request->input('kode_anggota');
			$data['kode_pendidikan_list'] = DB::select('select * from bkt_01010135_tkt_pendidikan where status=1');
			$data['kode_pekerjaan_list'] = DB::select('select * from bkt_01010134_pekerjaan where status=1');

			$data['pemilu_bkm'] = DB::select('select * from bkt_01020214_pemilu_bkm where kode='.$request->input('kode'));
			$data['anggota_pemilu_bkm_p'] = DB::select('select count(kode) cnt from bkt_01010133_anggt_bkm where kode_pemilu_bkm='.$request->input('kode').' and jenis_kelamin="L" and status!=2');
			$data['anggota_pemilu_bkm_w'] = DB::select('select count(kode) cnt from bkt_01010133_anggt_bkm where kode_pemilu_bkm='.$request->input('kode').' and jenis_kelamin="P" and status!=2');
			$data['anggota_pemilu_bkm_mbr'] = DB::select('select count(kode) cnt from bkt_01010133_anggt_bkm where kode_pemilu_bkm='.$request->input('kode').' and status_sosial=0 and status!=2');
			if($data['kode_bkm']!=null && !empty($data['detil']['589'])){
				
				$data['nama'] = null;
				$data['jenis_kelamin'] = null;
				$data['status_sosial'] = null;
				$data['umur'] = null;
				$data['kode_pendidikan'] = null;
				$data['kode_pekerjaan'] = null;
				$data['jml_dukungan'] = null;
				$data['status'] = null;
				// $data['kode_bkm'] = $rowData[0]->kode_bkm;
				// $data['nama'] = $rowData[0]->nama;
				// $data['jenis_kelamin'] = $rowData[0]->jenis_kelamin;
				// $data['status_sosial'] = $rowData[0]->status_sosial;
				// $data['umur'] = $rowData[0]->umur;
				// $data['kode_pendidikan'] = $rowData[0]->kode_pendidikan;
				// $data['kode_pekerjaan'] = $rowData[0]->kode_pekerjaan;
				// $data['jml_dukungan'] = $rowData[0]->jml_dukungan;
				// $data['status'] = $rowData[0]->status;
				return view('MAIN/bk010235/anggota',$data);
			}if($data['kode_anggota']!=null && !empty($data['detil']['589'])){
				$rowData=DB::select('select * from bkt_01010133_anggt_bkm where kode='.$request->input('kode_anggota'));
				$data['kode_bkm'] = $rowData[0]->kode_bkm;
				$data['nama'] = $rowData[0]->nama;
				$data['jenis_kelamin'] = $rowData[0]->jenis_kelamin;
				$data['status_sosial'] = $rowData[0]->status_sosial;
				$data['umur'] = $rowData[0]->umur;
				$data['kode_pendidikan'] = $rowData[0]->kode_pendidikan;
				$data['kode_pekerjaan'] = $rowData[0]->kode_pekerjaan;
				$data['jml_dukungan'] = $rowData[0]->jml_dukungan;
				$data['status'] = $rowData[0]->status;
				return view('MAIN/bk010235/anggota',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function anggota_post_create(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode_anggota')!=null){
			DB::table('bkt_01010133_anggt_bkm')->where('kode', $request->input('kode_anggota'))
			->update([
				'nama' => $request->input('nama'),
				'jenis_kelamin' => $request->input('jenis_kelamin'),
				'status_sosial' => $request->input('status_sosial'),
				'umur' => $request->input('umur'),
				'kode_pendidikan' => $request->input('kode-pendidikan-input'),
				'kode_pekerjaan' => $request->input('kode-pekerjaan-input'),
				'jml_dukungan' => $request->input('jml_dukungan'),
				'status' => $request->input('status'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update Anggota BKM', 589);

		}else{
			DB::table('bkt_01010133_anggt_bkm')->insert(
       			[
       			'kode_bkm' => $request->input('kode_bkm'),
       			'kode_pemilu_bkm' => $request->input('kode'),
       			'nama' => $request->input('nama'),
				'jenis_kelamin' => $request->input('jenis_kelamin'),
				'status_sosial' => 1,
				'umur' => $request->input('umur'),
				'kode_pendidikan' => $request->input('kode-pendidikan-input'),
				'kode_pekerjaan' => $request->input('kode-pekerjaan-input'),
				'jml_dukungan' => $request->input('jml_dukungan'),
				'status' => $request->input('status'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create Anggota BKM', 589);
		}

		$total_anggota_p=DB::select('select count(kode) as cnt from bkt_01010133_anggt_bkm where jenis_kelamin="L" and status!=2 and kode_bkm='.$request->input('kode_bkm'));
		$total_anggota_w=DB::select('select count(kode) as cnt from bkt_01010133_anggt_bkm where jenis_kelamin="P" and status!=2 and kode_bkm='.$request->input('kode_bkm'));
		$total_anggota_mbr=DB::select('select count(kode) as cnt from bkt_01010133_anggt_bkm where status_sosial=0 and status!=2 and kode_bkm='.$request->input('kode_bkm'));

		DB::table('bkt_01010125_bkm')->where('id', $request->input('kode_bkm'))
		->update([
			'jml_anggt' => $total_anggota_p[0]->cnt,
			'jml_anggt_w' => $total_anggota_w[0]->cnt,
			'jml_anggt_mbr' => $total_anggota_mbr[0]->cnt,
			'updated_by' => Auth::user()->id,
			'updated_time' => date('Y-m-d H:i:s')
			]);
	}

	public function anggota_delete(Request $request)
	{
		DB::beginTransaction();
		DB::table('bkt_01010133_anggt_bkm')->where('kode', $request->input('kode_anggota'))->update(['status' => 2]);
		DB::commit();

		$total_anggota_p=DB::select('select count(kode) as cnt from bkt_01010133_anggt_bkm where jenis_kelamin="L" and status!=2 and kode_bkm='.$request->input('kode_bkm').' and kode!='.$request->input('kode_anggota'));
		$total_anggota_w=DB::select('select count(kode) as cnt from bkt_01010133_anggt_bkm where jenis_kelamin="P" and status!=2 and kode_bkm='.$request->input('kode_bkm').' and kode!='.$request->input('kode_anggota'));
		$total_anggota_mbr=DB::select('select count(kode) as cnt from bkt_01010133_anggt_bkm where status_sosial=0 and status!=2 and kode_bkm='.$request->input('kode_bkm').' and kode!='.$request->input('kode_anggota'));

		if($request->input('kode_bkm')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01010125_bkm')->where('id', $request->input('kode_bkm'))
			->update([
				'jml_anggt' => $total_anggota_p[0]->cnt,
				'jml_anggt_w' => $total_anggota_w[0]->cnt,
				'jml_anggt_mbr' => $total_anggota_mbr[0]->cnt,
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
		}
        $this->log_aktivitas('Update Anggota BKM', 589);
        return Redirect::to('/main/persiapan/kelurahan/pemilu_bkm/data/create?kode='.$request->input('kode_pemilu'));
    }

	public function delete(Request $request)
	{
		//DB::table('bkt_01010133_anggt_bkm')->where('kode_bkm', $request->input('id'))->update(['status' => 2]);
		DB::table('bkt_01020212_forum_kel')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 201);
        return Redirect::to('/main/persiapan/kelurahan/forum/keanggotaan');
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
				'kode_menu' => 188,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
