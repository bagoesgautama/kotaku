<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010220Controller extends Controller
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
				if($item->kode_menu==70)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 198);
				return view('MAIN/bk010220/index',$data);
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
			0 =>'tahun',
			1 =>'kode_kota',
			3 =>'kode_kec',
			4 =>'kode_kel',
			5 =>'tgl_kegiatan',
			6 =>'q_anggota_p',
			7 =>'q_anggota_w',
			8 =>'created_time',
			9 =>'created_by',
			10 =>'updated_time',
			11 =>'updated_by'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_kec, d.nama nama_kel 
				from bkt_01020212_forum_kel a
				left join bkt_01010102_kota b on a.kode_kota=b.kode
				left join bkt_01010103_kec c on a.kode_kec=c.kode
				left join bkt_01010104_kel d on a.kode_kel=d.kode ';
		$totalData = DB::select('select count(1) cnt
									from bkt_01020212_forum_kel a
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
					a.jenis_kegiatan like "%'.$search.'%" or 
					a.tgl_kegiatan like "%'.$search.'%" or
					a.lok_kegiatan like "%'.$search.'%" or 
					a.tahun like "%'.$search.'%" )
					order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					a.kode like "%'.$search.'%" or 
					b.nama like "%'.$search.'%" or 
					c.nama like "%'.$search.'%" or
					d.nama like "%'.$search.'%" or 
					a.jenis_kegiatan like "%'.$search.'%" or 
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
				$url_show=url('/')."/main/persiapan/kelurahan/forum/keanggotaan/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/kelurahan/forum/keanggotaan/create?kode=".$show;
				$url_delete=url('/')."/main/persiapan/kelurahan/forum/keanggotaan/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['q_anggota_p'] = $post->q_anggota_p;
				$nestedData['q_anggota_w'] = $post->q_anggota_w;
				$nestedData['total_anggota'] = $post->q_anggota_p + $post->q_anggota_w;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==70)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['198'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['200'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['201'])){
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
				if($item->kode_menu==70)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['198'])){
				$rowData = DB::select('select * from bkt_01020212_forum_kel where kode='.$data['kode']);
				$data['detil_menu']='198';
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
				$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
				$data['q_anggota_pem_desa'] = $rowData[0]->q_anggota_pem_desa;
				$data['q_anggota_pem_bpd'] = $rowData[0]->q_anggota_pem_bpd;
				$data['q_anggota_non_pem'] = $rowData[0]->q_anggota_non_pem;
				$data['uri_dok_rencana_kerja'] = $rowData[0]->uri_dok_rencana_kerja;
				$data['nilai_dana_ops'] = $rowData[0]->nilai_dana_ops;
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
				$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01020212_forum_kel a, bkt_01010102_kota b where a.kode_kota=b.kode and a.kode='.$data['kode']);
				$data['kode_kec_list']=DB::select('select b.kode, b.nama from bkt_01020212_forum_kel a, bkt_01010103_kec b where a.kode_kec=b.kode and a.kode='.$data['kode']);
				$data['kode_kel_list']=DB::select('select b.kode, b.nama from bkt_01020212_forum_kel a, bkt_01010104_kel b where a.kode_kel=b.kode and a.kode='.$data['kode']);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010220/create',$data);
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
				if($item->kode_menu==70)
					$data['detil'][$item->kode_menu_detil]='a';
			}

			$data['username'] = '';
			$data['test']=true;
			$data['kode']=$request->input('kode');

			if($data['kode']!=null && !empty($data['detil']['200'])){
				$rowData = DB::select('select * from bkt_01020212_forum_kel where kode='.$data['kode']);
				$data['detil_menu']='200';
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
				$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
				$data['q_anggota_pem_desa'] = $rowData[0]->q_anggota_pem_desa;
				$data['q_anggota_pem_bpd'] = $rowData[0]->q_anggota_pem_bpd;
				$data['q_anggota_non_pem'] = $rowData[0]->q_anggota_non_pem;
				$data['uri_dok_rencana_kerja'] = $rowData[0]->uri_dok_rencana_kerja;
				$data['nilai_dana_ops'] = $rowData[0]->nilai_dana_ops;
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
				if(empty($user->kode_faskel) && empty($user->kode_korkot)){
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				}else if(!empty($user->kode_faskel)){
					$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode='.$rowData[0]->kode_kec);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode='.$rowData[0]->kode_kel);
				}else if(empty($user->kode_faskel)){
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				}	
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010220/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['199'])){
				$dataUser = DB::select('select a.*,
											a.kode_kmp kode_kmp_real, 
											a.kode_kmw kode_kmw_real, 
											a.kode_korkot kode_korkot_real, 
											a.kode_faskel kode_faskel_real,
											c.kode kode_kec, 
											c.nama nama_kec
										from bkt_02010111_user a
											left join bkt_01010104_kel b on a.wk_kd_kel=b.kode
											left join bkt_01010103_kec c on b.kode_kec=c.kode
										where a.id='.$user->id);
				$data['detil_menu']='199';
				$data['kode_kmw'] = $dataUser[0]->kode_kmw_real;
				$data['kode_korkot'] = $dataUser[0]->kode_korkot_real;
				$data['kode_faskel'] = $dataUser[0]->kode_faskel_real;
				$data['tahun'] = null;
				$data['jenis_kegiatan'] = null;
				$data['tgl_kegiatan'] = null;
				$data['q_anggota_p'] = null;
				$data['q_anggota_w'] = null;
				$data['q_anggota_pem_desa'] = null;
				$data['q_anggota_pem_bpd'] = null;
				$data['q_anggota_non_pem'] = null;
				$data['uri_dok_rencana_kerja'] = null;
				$data['nilai_dana_ops'] = null;
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
				if(empty($user->kode_faskel) && empty($user->kode_korkot)){
					$data['kode_korkot'] = null;
					$data['kode_faskel'] = null;
					$data['kode_kota'] = null;
					$data['kode_kec'] = null;
					$data['kode_kel'] = null;
					$data['kode_kota_list']=DB::select('select a.kode, a.nama from bkt_01010102_kota a, bkt_02010111_user b where a.kode_prop=b.wk_kd_prop and b.id='.$user->id);
					$data['kode_kec_list'] = null;
					$data['kode_kel_list'] = null;
				}else if(!empty($user->kode_faskel)){
					$data['kode_kota'] = $dataUser[0]->wk_kd_kota;
					$data['kode_kec'] = $dataUser[0]->kode_kec;
					$data['kode_kel'] = $dataUser[0]->wk_kd_kel;
					$data['kode_kota_list']=DB::select('select a.kode, a.nama 
														from bkt_01010102_kota a, bkt_01010104_kel b, bkt_01010103_kec c, bkt_02010111_user d 
														where b.kode=d.wk_kd_kel and b.kode_kec=c.kode and c.kode_kota=a.kode and d.id='.$user->id);
					$data['kode_kec_list']=DB::select('select a.kode, a.nama 
														from bkt_01010103_kec a, bkt_01010104_kel b, bkt_02010111_user c 
														where b.kode=c.wk_kd_kel and b.kode_kec=a.kode and c.id=88');
					$data['kode_kel_list']=DB::select('select a.kode, a.nama 
														from bkt_01010104_kel a, bkt_02010111_user b 
														where a.kode=b.wk_kd_kel and b.id='.$user->id);
				}else if(empty($user->kode_faskel)){
					$data['kode_faskel'] = null;
					$data['kode_kota'] = null;
					$data['kode_kec'] = null;
					$data['kode_kel'] = null;
					$data['kode_kota_list']=DB::select('select a.kode, a.nama from bkt_01010102_kota a, bkt_02010111_user b, bkt_01010112_kota_korkot c where b.kode_korkot=c.kode_korkot and c.kode_kota=a.kode and b.id='.$user->id);
					$data['kode_kec_list'] = null;
					$data['kode_kel_list'] = null;
				}
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010220/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function select(Request $request)
	{
		if(!empty($request->input('kec'))){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kec'));
			echo json_encode($kec);
		}
		if(!empty($request->input('kel'))){
			$kel = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kel'));
			echo json_encode($kel);
		}
		if(!empty($request->input('korkot'))){
			$korkot = DB::select('select kode_korkot from bkt_01010112_kota_korkot where kode_kota='.$request->input('korkot'));
			echo json_encode($korkot);
		}
		if(!empty($request->input('faskel'))){
			$faskel = DB::select('select kode_faskel from bkt_01010114_kel_faskel where kode_kel='.$request->input('faskel'));
			echo json_encode($faskel);
		}
	}

	public function post_create(Request $request)
	{

		$file_dok_rencana_kerja = $request->file('file-dok_rencana_kerja-input');
		$uri_dok_rencana_kerja = null;
		$upload_dok_rencana_kerja = false;
		if($request->input('uploaded-file-dok_rencana_kerja') != null && $file_dok_rencana_kerja == null){
			$uri_dok_rencana_kerja = $request->input('uploaded-file-dok_rencana_kerja');
			$upload_dok_rencana_kerja = false;
		}elseif($request->input('uploaded-file-dok_rencana_kerja') != null && $file_dok_rencana_kerja != null){
			$uri_dok_rencana_kerja = $file_dok_rencana_kerja->getClientOriginalName();
			$upload_dok_rencana_kerja = true;
		}elseif($request->input('uploaded-file-dok_rencana_kerja') == null && $file_dok_rencana_kerja != null){
			$uri_dok_rencana_kerja = $file_dok_rencana_kerja->getClientOriginalName();
			$upload_dok_rencana_kerja = true;
		}

		$file_document = $request->file('file-document-input');
		$uri_document = null;
		$upload_document = false;
		if($request->input('uploaded-file-document') != null && $file_document == null){
			$uri_document = $request->input('uploaded-file-document');
			$upload_document = false;
		}elseif($request->input('uploaded-file-document') != null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}elseif($request->input('uploaded-file-document') == null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}

		$file_absensi = $request->file('file-absensi-input');
		$uri_absensi = null;
		$upload_absensi = false;
		if($request->input('uploaded-file-absensi') != null && $file_absensi == null){
			$uri_absensi = $request->input('uploaded-file-absensi');
			$upload_absensi = false;
		}elseif($request->input('uploaded-file-absensi') != null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uploaded-file-absensi') == null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_01020212_forum_kel')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'kode_kmw' => $request->input('kode_kmw-input'),
				'kode_korkot' => $request->input('kode_korkot-input'),
				'kode_faskel' => $request->input('kode_faskel-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'jenis_kegiatan' => '2.6.1',
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl_kegiatan-input')),
				'q_anggota_p' => $request->input('q_anggota_p-input'),
				'q_anggota_w' => $request->input('q_anggota_w-input'),
				'q_anggota_pem_desa' => $request->input('q_anggota_pem_desa-input'),
				'q_anggota_pem_bpd' => $request->input('q_anggota_pem_bpd-input'),
				'q_anggota_non_pem' => $request->input('q_anggota_non_pem-input'),
				'uri_dok_rencana_kerja' => $uri_dok_rencana_kerja,
				'nilai_dana_ops' => $request->input('nilai_dana_ops-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

			if($upload_dok_rencana_kerja == true){
				$file_dok_rencana_kerja->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_dok_rencana_kerja->getClientOriginalName());
			}

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 200);

		}else{
			DB::table('bkt_01020212_forum_kel')->insert(
       			['tahun' => $request->input('tahun-input'),
       			'kode_kmw' => $request->input('kode_kmw-input'),
				'kode_korkot' => $request->input('kode_korkot-input'),
				'kode_faskel' => $request->input('kode_faskel-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'jenis_kegiatan' => '2.6.1',
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl_kegiatan-input')),
				'q_anggota_p' => $request->input('q_anggota_p-input'),
				'q_anggota_w' => $request->input('q_anggota_w-input'),
				'q_anggota_pem_desa' => $request->input('q_anggota_pem_desa-input'),
				'q_anggota_pem_bpd' => $request->input('q_anggota_pem_bpd-input'),
				'q_anggota_non_pem' => $request->input('q_anggota_non_pem-input'),
				'uri_dok_rencana_kerja' => $uri_dok_rencana_kerja,
				'nilai_dana_ops' => $request->input('nilai_dana_ops-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_dok_rencana_kerja == true){
				$file_dok_rencana_kerja->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_dok_rencana_kerja->getClientOriginalName());
			}

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 199);
		}
	}

	public function delete(Request $request)
	{
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
				'kode_menu' => 70,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
