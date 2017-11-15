<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010219Controller extends Controller
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
				if($item->kode_menu==65)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

			    $this->log_aktivitas('View', 246);
				return view('MAIN/bk010219/index',$data);
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
			1 =>'kode_kota',
			2 =>'kode_kec',
			3 =>'kode_kel',
			4 =>'tahun',
			5 =>'id_pelatihan',
			6 =>'tgl_kegiatan',
			7 =>'lok_kegiatan',
			8 =>'q_peserta_p',
			9 =>'q_peserta_w',
			10 =>'q_peserta_mbr',
			11 =>'nilai_dana'
		);
		$query='select * from (select 
					a.*,
					a.kode kode_pelmas, 
					c.nama nama_kota, 
					d.nama nama_kec, 
					e.nama nama_kel, 
					f.nama nama_korkot, 
					g.nama nama_faskel, 
					h.nama nama_pelatihan, 
					a.tahun tahun_pelmas,
					a.tgl_kegiatan tgl_kegiatan_pelmas, 
					a.lok_kegiatan lok_kegiatan_pelmas
				from bkt_01020211_pelmas_kel a
				 	left join bkt_01010101_prop b on a.kode_prop = b.kode
				 	left join bkt_01010102_kota c on a.kode_kota = c.kode
				 	left join bkt_01010103_kec d on a.kode_kec = d.kode
				 	left join bkt_01010104_kel e on a.kode_kel = e.kode
				 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
				 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
				 	left join bkt_01010117_pelatihan_kel h on a.id_pelatihan = h.id) b ';
		$totalData = DB::select('select count(1) cnt from bkt_01020211_pelmas_kel a
								 	left join bkt_01010101_prop b on a.kode_prop = b.kode
								 	left join bkt_01010102_kota c on a.kode_kota = c.kode
								 	left join bkt_01010103_kec d on a.kode_kec = d.kode
								 	left join bkt_01010104_kel e on a.kode_kel = e.kode
								 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
								 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
								 	left join bkt_01010117_pelatihan_kel h on a.id_pelatihan = h.id');
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
				b.kode_pelmas like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or
				b.nama_kec like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%" or
				b.nama_pelatihan like "%'.$search.'%" or   
				b.tahun_pelmas like "%'.$search.'%" or  
				b.lok_kegiatan_pelmas like "%'.$search.'%" or
				b.tgl_kegiatan_pelmas like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_pelmas like "%'.$search.'%" or 
				b.nama_prop like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or
				b.nama_kec like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%" or
				b.nama_pelatihan like "%'.$search.'%" or  
				b.tahun_pelmas like "%'.$search.'%" or   
				b.lok_kegiatan_pelmas like "%'.$search.'%" or
				b.tgl_kegiatan_pelmas like "%'.$search.'%")) a');
			$totalFiltered = $totalFiltered[0]->cnt;
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
				$url_show=url('/')."/main/persiapan/kelurahan/pelatihan/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/kelurahan/pelatihan/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/kelurahan/pelatihan/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_pelmas;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_kec'] = $post->nama_kec;
				$nestedData['kode_kel'] = $post->nama_kel;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_faskel'] = $post->nama_faskel;
				$nestedData['tahun'] = $post->tahun_pelmas;
				$nestedData['id_pelatihan'] = $post->nama_pelatihan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan_pelmas;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan_pelmas;
				$nestedData['q_peserta_p'] = $post->q_peserta_p;
				$nestedData['q_peserta_w'] = $post->q_peserta_w;
				$nestedData['q_peserta_mbr'] = $post->q_peserta_mbr;
				$nestedData['nilai_dana'] = $post->rp_dana_bdi + $post->rp_dana_swadaya;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==65)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['246'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['248'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['249'])){
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
				if($item->kode_menu==65)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['246'])){
				$rowData = DB::select('select * from bkt_01020211_pelmas_kel where kode='.$data['kode']);
				$data['detil_menu']='246';
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['tahun'] = $rowData[0]->tahun;
				$data['id_pelatihan'] = $rowData[0]->id_pelatihan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_peserta_mbr'] = $rowData[0]->q_peserta_mbr;
				$data['rp_dana_bdi'] = $rowData[0]->rp_dana_bdi;
				$data['rp_dana_swadaya'] = $rowData[0]->rp_dana_swadaya;
				$data['keterangan'] = $rowData[0]->keterangan;
				$data['uri_img_berita_acara'] = $rowData[0]->uri_img_berita_acara;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['diser_tgl'] = $rowData[0]->diser_tgl;
				$data['diser_oleh'] = $rowData[0]->diser_oleh;
				$data['diket_tgl'] = $rowData[0]->diket_tgl;
				$data['diket_oleh'] = $rowData[0]->diket_oleh;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
				$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode='.$rowData[0]->kode_kec);
				$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode='.$rowData[0]->kode_kel);
				$data['tahun_list'] = DB::select('select tahun from list_tahun where tahun='.$rowData[0]->tahun);
				$data['kode_pelatihan_list'] = DB::select('select * from bkt_01010117_pelatihan_kel where status=1 and id='.$rowData[0]->id_pelatihan);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010219/create',$data);
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
				if($item->kode_menu==65)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			    $data['username'] = $user->name;
				$data['kode']=$request->input('kode');
				$data['tahun_list'] = DB::select('select * from list_tahun');
				if($data['kode']!=null && !empty($data['detil']['248'])){
					$rowData = DB::select('select * from bkt_01020211_pelmas_kel where kode='.$data['kode']);
					$data['detil_menu']='248';
					$data['kode_kota'] = $rowData[0]->kode_kota;
					$data['kode_kec'] = $rowData[0]->kode_kec;
					$data['kode_kel'] = $rowData[0]->kode_kel;
					$data['kode_korkot'] = $rowData[0]->kode_korkot;
					$data['kode_faskel'] = $rowData[0]->kode_faskel;
					$data['tahun'] = $rowData[0]->tahun;
					$data['id_pelatihan'] = $rowData[0]->id_pelatihan;
					$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
					$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
					$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
					$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
					$data['q_peserta_mbr'] = $rowData[0]->q_peserta_mbr;
					$data['rp_dana_bdi'] = $rowData[0]->rp_dana_bdi;
					$data['rp_dana_swadaya'] = $rowData[0]->rp_dana_swadaya;
					$data['keterangan'] = $rowData[0]->keterangan;
					$data['uri_img_berita_acara'] = $rowData[0]->uri_img_berita_acara;
					$data['uri_img_document'] = $rowData[0]->uri_img_document;
					$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
					$data['diser_tgl'] = $rowData[0]->diser_tgl;
					$data['diser_oleh'] = $rowData[0]->diser_oleh;
					$data['diket_tgl'] = $rowData[0]->diket_tgl;
					$data['diket_oleh'] = $rowData[0]->diket_oleh;
					$data['diver_tgl'] = $rowData[0]->diver_tgl;
					$data['diver_oleh'] = $rowData[0]->diver_oleh;
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
					$data['kode_pelatihan_list'] = DB::select('select * from bkt_01010117_pelatihan_kel where status=1');
					$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
					return view('MAIN/bk010219/create',$data);
				}else if($data['kode']==null && !empty($data['detil']['247'])){
					$data['detil_menu']='247';
					$dataUser = DB::select('select * from bkt_02010111_user where id='.$user->id);
					$data['kode_kmw'] = $dataUser[0]->kode_kmw;
					$data['kode_korkot'] = $dataUser[0]->kode_korkot;
					$data['kode_faskel'] = $dataUser[0]->kode_faskel;
					$data['kode_kota'] = null;
					$data['kode_kec'] = null;
					$data['kode_kel'] = null;
					$data['tahun'] = null;
					$data['id_pelatihan'] = null;
					$data['tgl_kegiatan'] = null;
					$data['lok_kegiatan'] = null;
					$data['q_peserta_p'] = null;
					$data['q_peserta_w'] = null;
					$data['q_peserta_mbr'] = null;
					$data['rp_dana_bdi'] = null;
					$data['rp_dana_swadaya'] = null;
					$data['keterangan'] = null;
					$data['uri_img_berita_acara'] = null;
					$data['uri_img_document'] = null;
					$data['uri_img_absensi'] = null;
					$data['diser_tgl'] = null;
					$data['diser_oleh'] = null;
					$data['diket_tgl'] = null;
					$data['diket_oleh'] = null;
					$data['diver_tgl'] = null;
					$data['diver_oleh'] = null;
					$data['created_time'] = null;
					$data['created_by'] = null;
					$data['updated_time'] = null;
					$data['updated_by'] = null;
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
					$data['kode_pelatihan_list'] = DB::select('select * from bkt_01010117_pelatihan_kel where status=1');
					$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
					return view('MAIN/bk010219/create',$data);
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
		$file_berita_acara = $request->file('uri_img_berita_acara-input');
		$uri_berita_acara = null;
		$upload_berita_acara = false;
		if($request->input('uri_img_berita_acara-file') != null && $file_berita_acara == null){
			$uri_berita_acara = $request->input('uri_img_berita_acara-file');
			$upload_berita_acara = false;
		}elseif($request->input('uri_img_berita_acara-file') != null && $file_berita_acara != null){
			$uri_berita_acara = $file_berita_acara->getClientOriginalName();
			$upload_berita_acara = true;
		}elseif($request->input('uri_img_berita_acara-file') == null && $file_berita_acara != null){
			$uri_berita_acara = $file_berita_acara->getClientOriginalName();
			$upload_berita_acara = true;
		}

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

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020211_pelmas_kel')->where('kode', $request->input('kode'))
			->update([
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_korkot' => $request->input('kode_korkot-input'), 
				'kode_faskel' => $request->input('kode_faskel-input'), 
				'tahun' => $request->input('tahun-input'),   
				'id_pelatihan' => $request->input('id-pelatihan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_mbr' => $request->input('q-mbr-input'),
				'rp_dana_bdi' => $request->input('rp-bdi-input'),
				'rp_dana_swadaya' => $request->input('rp-swadaya-input'),
				'keterangan' => $request->input('keterangan-input'),
				'uri_img_berita_acara' => $uri_berita_acara,
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id, 
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/pelatihan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/pelatihan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 248);

		}else{
			DB::table('bkt_01020211_pelmas_kel')->insert([
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_korkot' => $request->input('kode_korkot-input'), 
				'kode_faskel' => $request->input('kode_faskel-input'),  
				'tahun' => $request->input('tahun-input'),   
				'id_pelatihan' => $request->input('id-pelatihan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_mbr' => $request->input('q-mbr-input'),
				'rp_dana_bdi' => $request->input('rp-bdi-input'),
				'rp_dana_swadaya' => $request->input('rp-swadaya-input'),
				'keterangan' => $request->input('keterangan-input'),
				'uri_img_berita_acara' => $uri_berita_acara,
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/pelatihan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/pelatihan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 247);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020211_pelmas_kel')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 249);
        return Redirect::to('/main/persiapan/kelurahan/pelatihan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 65,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
