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

	public function show()
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('/main/persiapan/kelurahan/forum/keanggotaan',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'tahun',
			1 =>'kode_kota',
			2 =>'kode_korkot',
			3 =>'kode_kec',
			4 =>'kode_kmw',
			5 =>'kode_kel',
			6 =>'kode_faskel',
			7 =>'jenis_kegiatan',
			8 =>'tgl_kegiatan',
			9 =>'lok_kegiatan',
			10 =>'q_anggota_p',
			11 =>'q_anggota_w',
			12 =>'q_anggota_pem_desa',
			13 =>'q_anggota_pem_bpd',
			14 =>'q_anggota_non_pem',
			15 =>'uri_dok_rencana_kerja',
			16 =>'nilai_dana_ops',
			17 =>'uri_img_document',
			18 =>'uri_img_absensi',
			19 =>'diser_tgl',
			20 =>'diser_oleh',
			21 =>'diket_tgl',
			22 =>'diket_oleh',
			23 =>'diver_tgl',
			24 =>'diver_oleh',
			25 =>'created_time',
			26 =>'created_by',
			27 =>'updated_time',
			28 =>'updated_by'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kec, e.nama nama_kmw, f.nama nama_kel, g.nama nama_faskel
			from bkt_01020212_forum_kel a, bkt_01010102_kota b, bkt_01010111_korkot c, bkt_01010103_kec d, bkt_01010110_kmw e, bkt_01010104_kel f, bkt_01010113_faskel g, bkt_01010118_kegiatan_kel h where b.kode=a.kode_kota and c.kode=a.kode_korkot and d.kode=a.kode_kec and e.kode=a.kode_kmw and f.kode=a.kode_kel and g.kode=a.kode_faskel';
		$totalData = DB::select('select count(1) cnt from bkt_01020215_lembaga_kel ');
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
			$posts=DB::select($query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/persiapan/kelurahan/forum/keanggotaan/create?kode=".$show;
				$url_delete=url('/')."/main/persiapan/kelurahan/forum/keanggotaan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_kel'] = $post->nama_kec;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['jenis_kegiatan'] = $post->jenis_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['q_anggota_p'] = $post->q_anggota_p;
				$nestedData['q_anggota_w'] = $post->q_anggota_w;
				$nestedData['q_anggota_pem_desa'] = $post->q_anggota_pem_desa;
				$nestedData['q_anggota_pem_bpd'] = $post->q_anggota_pem_bpd;
				$nestedData['q_anggota_non_pem'] = $post->q_anggota_non_pem;
				$nestedData['uri_dok_rencana_kerja'] = $post->uri_dok_rencana_kerja;
				$nestedData['nilai_dana_ops'] = $post->nilai_dana_ops;
				$nestedData['uri_img_document'] = $post->uri_img_document;
				$nestedData['uri_img_absensi'] = $post->uri_img_absensi;
				$nestedData['diser_tgl'] = $post->diser_tgl;
				$nestedData['diser_oleh'] = $post->diser_oleh;
				$nestedData['diket_tgl'] = $post->diket_tgl;
				$nestedData['diket_oleh'] = $post->diket_oleh;
				$nestedData['diver_tgl'] = $post->diver_tgl;
				$nestedData['diver_oleh'] = $post->diver_oleh;
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

			//get dropdown list from Database
			$kode_kota = DB::select('select kode, nama from bkt_01010102_kota');
			$data['kode_kota_list'] = $kode_kota;

			$kode_korkot = DB::select('select kode, nama from bkt_01010111_korkot');
			$data['kode_korkot_list'] = $kode_korkot;

			$kode_kec = DB::select('select kode, nama from bkt_01010103_kec');
			$data['kode_kec_list'] = $kode_kec;

			$kode_kmw = DB::select('select kode, nama from bkt_01010110_kmw');
			$data['kode_kmw_list'] = $kode_kmw;

			$kode_kel = DB::select('select kode, nama from bkt_01010104_kel');
			$data['kode_kel_list'] = $kode_kel;

			$kode_faskel = DB::select('select kode, nama from bkt_01010113_faskel');
			$data['kode_faskel_list'] = $kode_faskel;

			if($data['kode']!=null && !empty($data['detil']['200'])){
				$rowData = DB::select('select * from bkt_01020212_forum_kel where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
				$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
				$data['q_anggota_pem_desa'] = $rowData[0]->q_anggota_pem_desa;
				$data['q_anggota_pem_bpd'] = $rowData[0]->q_anggota_pem_bpd;
				$data['q_anggota_non_pem'] = $rowData[0]->q_anggota_non_pem;
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
				return view('MAIN/bk010220/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['199'])){
				$data['tahun'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['jenis_kegiatan'] = null;
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['q_anggota_p'] = null;
				$data['q_anggota_w'] = null;
				$data['q_anggota_pem_desa'] = null;
				$data['q_anggota_pem_bpd'] = null;
				$data['q_anggota_non_pem'] = null;
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

<<<<<<< HEAD
		if($data['kode']!=null && !empty($data['detil']['200'])){
			$rowData = DB::select('select * from bkt_01020212_forum_kel where kode='.$data['kode']);
			$data['tahun'] = $rowData[0]->tahun;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['kode_korkot'] = $rowData[0]->kode_korkot;
			$data['kode_kec'] = $rowData[0]->kode_kec;
			$data['kode_kmw'] = $rowData[0]->kode_kmw;
			$data['kode_kel'] = $rowData[0]->kode_kel;
			$data['kode_faskel'] = $rowData[0]->kode_faskel;
			$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
			$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
			$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
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
			view('MAIN/bk010220/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['199'])){
			$data['tahun'] = null;
			$data['kode_kota'] = null;
			$data['kode_korkot'] = null;
			$data['kode_kec'] = null;
			$data['kode_kmw'] = null;
			$data['kode_kel'] = null;
			$data['kode_faskel'] = null;
			$data['jenis_kegiatan'] = null;
			$data['tgl_kegiatan'] = null;
			$data['lok_kegiatan'] = null;
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
		
			return view('MAIN/bk010220/create',$data);
=======
				return view('MAIN/bk010220/create',$data);
>>>>>>> 44b0e6f17db53a973e09acb0eb00c4ce5381e0d0
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$file_dok_rencana_kerja = $request->file('file-dok_rencana-kerja-input');
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

		$file_dokumen = $request->file('file-dokumen-input');
		$uri_dokumen = null;
		$upload_dokumen = false;
		if($request->input('uploaded-file-dokumen') != null && $file_dokumen == null){
			$uri_dokumen = $request->input('uploaded-file-dokumen');
			$upload_dokumen = false;
		}elseif($request->input('uploaded-file-dokumen') != null && $file_dokumen != null){
			$uri_dokumen = $file_dokumen->getClientOriginalName();
			$upload_dokumen = true;
		}elseif($request->input('uploaded-file-dokumen') == null && $file_dokumen != null){
			$uri_dokumen = $file_dokumen->getClientOriginalName();
			$upload_dokumen = true;
		}

		$file_absensi = $request->file('file-absensi-input');
		$url_absensi = null;
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
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_01020212_forum_kel')->where('kode', $request->input('example-id-input'))
<<<<<<< HEAD
			->update(['tahun' => $request->input('tahun-input'), 
				'kode_kota' => $request->input('select-kode_kota-input'), 
				'kode_korkot' => $request->input('select-kode_korkot-input'), 
				'kode_kec' => $request->input('select-kode_kec-input'), 
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('select-select-jenis_kegiatan'),
				'tgl_kegiatan' => $request->input('tgl_kegiatan-input'),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'q_anggota_p' => $request->input('q_anggota_p-input'),
				'q_anggota_w' => $request->input('q_anggota_w-input'),
				'q_anggota_pem_desa' => $request->input('q_anggota_pem_desa-input'),
				'q_anggota_pem_bpd' => $request->input('q_anggota_pem_bpd-input'),
				'q_anggota_non_pem' => $request->input('q_anggota_non_pem-input'),
				'uri_dok_rencana_kerja' => $uri_dok_rencana_kerja,
				'nilai_dana_ops' => $request->input('nilai_dana_ops-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $$uri_absensi,
				'diser_tgl' => $request->input('diser_tgl-input'),
				'diser_oleh' => $request->input('diser_oleh-input'),
				'diket_tgl' => $request->input('diket_tgl-input'),
				'diket_oleh' => $request->input('diket_oleh-input'),
				'diver_tgl' => $request->input('diver_tgl-input'),
				'diver_oleh' => $request->input('diver_oleh-input'),
=======
			->update(['tahun' => $request->input('example-tahun-input'),
				'kode_kota' => $request->input('example-kode_kota-input'),
				'kode_korkot' => $request->input('example-kode_korkot-input'),
				'kode_kec' => $request->input('example-kode_kec-input'),
				'kode_kmw' => $request->input('example-kode_kmw-input'),
				'kode_kel' => $request->input('example-kode_kel-input'),
				'kode_faskel' => $request->input('example-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('example-select-jenis_kegiatan'),
				'tgl_kegiatan' => $request->input('example-tgl_kegiatan-input'),
				'lok_kegiatan' => $request->input('example-lok_kegiatan-input'),
				'q_anggota_p' => $request->input('example-q_anggota_p-input'),
				'q_anggota_w' => $request->input('example-q_anggota_w-input'),
				'q_anggota_pem_desa' => $request->input('example-q_anggota_pem_desa-input'),
				'q_anggota_pem_bpd' => $request->input('example-q_anggota_pem_bpd-input'),
				'q_anggota_non_pem' => $request->input('example-q_anggota_non_pem-input'),
				'diser_tgl' => $request->input('diser_tgl'),
				'diser_oleh' => $request->input('example-diser_oleh-input'),
				'diket_tgl' => $request->input('diket_tgl'),
				'diket_oleh' => $request->input('example-diket_oleh-input'),
				'diver_tgl' => $request->input('diver_tgl'),
				'diver_oleh' => $request->input('example-diver_oleh-input'),
>>>>>>> 44b0e6f17db53a973e09acb0eb00c4ce5381e0d0
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_absensi->getClientOriginalName());
			}

			if($upload_dok_rencana_kerja == true){
				$file_dok_rencana_kerja->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_dok_rencana_kerja->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 200);

		}else{
			DB::table('bkt_01020212_forum_kel')->insert(
<<<<<<< HEAD
       			['tahun' => $request->input('tahun-input'), 
				'kode_kota' => $request->input('select-kode_kota-input'), 
				'kode_korkot' => $request->input('select-kode_korkot-input'), 
				'kode_kec' => $request->input('select-kode_kec-input'), 
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('select-select-jenis_kegiatan'),
				'tgl_kegiatan' => $request->input('tgl_kegiatan-input'),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'q_anggota_p' => $request->input('q_anggota_p-input'),
				'q_anggota_w' => $request->input('q_anggota_w-input'),
				'q_anggota_pem_desa' => $request->input('q_anggota_pem_desa-input'),
				'q_anggota_pem_bpd' => $request->input('q_anggota_pem_bpd-input'),
				'q_anggota_non_pem' => $request->input('q_anggota_non_pem-input'),
				'uri_dok_rencana_kerja' => $uri_dok_rencana_kerja,
				'nilai_dana_ops' => $request->input('nilai_dana_ops-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $$uri_absensi,
				'diser_tgl' => $request->input('diser_tgl-input'),
				'diser_oleh' => $request->input('diser_oleh-input'),
				'diket_tgl' => $request->input('diket_tgl-input'),
				'diket_oleh' => $request->input('diket_oleh-input'),
				'diver_tgl' => $request->input('diver_tgl-input'),
				'diver_oleh' => $request->input('diver_oleh-input'),
=======
       			['tahun' => $request->input('example-tahun-input'),
				'kode_kota' => $request->input('example-kode_kota-input'),
				'kode_korkot' => $request->input('example-kode_korkot-input'),
				'kode_kec' => $request->input('example-kode_kec-input'),
				'kode_kmw' => $request->input('example-kode_kmw-input'),
				'kode_kel' => $request->input('example-kode_kel-input'),
				'kode_faskel' => $request->input('example-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('example-select-jenis_kegiatan'),
				'tgl_kegiatan' => $request->input('example-tgl_kegiatan-input'),
				'lok_kegiatan' => $request->input('example-lok_kegiatan-input'),
				'q_anggota_p' => $request->input('example-q_anggota_p-input'),
				'q_anggota_w' => $request->input('example-q_anggota_w-input'),
				'q_anggota_pem_desa' => $request->input('example-q_anggota_pem_desa-input'),
				'q_anggota_pem_bpd' => $request->input('example-q_anggota_pem_bpd-input'),
				'q_anggota_non_pem' => $request->input('example-q_anggota_non_pem-input'),
				'diser_tgl' => $request->input('diser_tgl'),
				'diser_oleh' => $request->input('example-diser_oleh-input'),
				'diket_tgl' => $request->input('diket_tgl'),
				'diket_oleh' => $request->input('example-diket_oleh-input'),
				'diver_tgl' => $request->input('diver_tgl'),
				'diver_oleh' => $request->input('example-diver_oleh-input'),
>>>>>>> 44b0e6f17db53a973e09acb0eb00c4ce5381e0d0
				'created_by' => Auth::user()->id
       			]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_absensi->getClientOriginalName());
			}

			if($upload_dok_rencana_kerja == true){
				$file_dok_rencana_kerja->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan'), $file_dok_rencana_kerja->getClientOriginalName());
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
