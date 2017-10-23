<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010408Controller extends Controller
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
				if($item->kode_menu==120)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 374);
				return view('MAIN/bk010408/index',$data);
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
			0 =>'jns_sumber_dana',
			1 => 'kode_parent',
			2 => 'kode_kmw',
			3 => 'kode_kota',
			4 => 'kode_korkot',
			5 => 'kode_kec',
			6 => 'kode_kel',
			7 => 'kode_faskel',
			8 => 'kode_kawasan',
			9 => 'id_ksm',
			10 => 'tahun',
			11 => 'tgl_realisasi',
			12 => 'vol_realisasi',
			13 => 'satuan',
			14 => 'nb_a_pupr_bdi_kolab',
			15 => 'nb_a_pupr_bdi_plbk',
			16 => 'nb_a_pupr_bdi_lain',
			17 => 'nb_a_pupr_nsup2',
			18 => 'nb_a_pupr_dir_pkp',
			19 => 'nb_a_pupr_dir_pkp_lain',
			20 => 'nb_apbn_kl_lain',
			21 => 'nb_apbd_prop',
			22 => 'nb_apbd_kota',
			23 => 'nb_dak',
			24 => 'nb_hibah',
			25 => 'nb_non_gov',
			26 => 'nb_masyarakat',
			27 => 'nb_lainnya',
			28 => 'progress_keuangan',
			29 => 'tpm_q_jiwa',
			30 => 'tpm_q_jiwa_w',
			31 => 'tpm_q_mbr',
			32 => 'tpm_q_kk',
			33 => 'tpm_q_kk_miskin',
			34 => 'tk_q_pekerja',
			35 => 'tk_q_pekerja_w',
			36 => 'tk_q_hok',
			37 => 'id_kpp',
			38 => 'kpp_flag_bgn_msh_ada',
			39 => 'kpp_flag_bgn_msh_baik',
			40 => 'kpp_flag_bgn_msh_fungsi',
			41 => 'kpp_flag_bgn_msh_man',
			42 => 'kpp_flag_bgn_msh_dev',
			43 => 'hasil_sertifikasi',
			44 => 'longitude',
			45 => 'latitude',
			46 => 'flag_foto_prcn0',
			47 => 'url_img_prcn0',
			48 => 'flag_foto_prcn50',
			49 => 'url_img_prcn50',
			50 => 'kpp_flag_bgn_msh_dev',
			51 => 'flag_foto_prcn100',
			52 => 'url_img_prcn100',
			53 => 'pencairan_dana1',
			54 => 'pencairan_dana2',
			55 => 'pencairan_dana3',
			56 => 'pemanfaatan_dana',
			57 => 'pemanfaatan_dana_prcn',
			58 => 'progress_fisik',
			59 => 'flag_sudah_sertias',
			60 => 'tgl_sertias',
			61 => 'uri_img_document',
			62 => 'uri_img_absensi',
			63 => 'diser_tgl',
			64 => 'diser_oleh',
			65 => 'diket_tgl',
			66 => 'diket_oleh',
			67 => 'diver_tgl',
			68 => 'diver_oleh',
			69 => 'created_time',
			70 => 'created_by',
			71 => 'updated_time',
			72 => 'updated_by'
		);
		$query='select a.*, b.nama nama_prop, c.nama nama_kota, d.nama nama_korkot, e.nama nama_kec, f.nama nama_kawasan
			 from bkt_01030206_plan_kaw_prior a, 
			 	bkt_01010101_prop b, 
			 	bkt_01010102_kota c, 
			 	bkt_01010111_korkot d, 
			 	bkt_01010103_kec e,
			 	bkt_01010123_kawasan f
			 where a.kode_prop=b.kode and a.kode_kota=c.kode and a.kode_korkot=d.kode and a.kode_kec=e.kode and a.kode_kawasan=f.id';
			 
		$totalData = DB::select('select count(1) cnt from bkt_01030206_plan_kaw_prior ');
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
			$posts=DB::select($query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_edit=url('/')."/main/pelaksanaan/kelurahan/pagu_pencairan/create?kode=".$show;
				$url_delete=url('/')."/main/pelaksanaan/kelurahan/pagu_pencairan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['tgl_transaksi'] = $post->tgl_transaksi;
				$nestedData['termin'] = $post->termin;
				$nestedData['jns_program'] = $post->jns_program;
				$nestedData['jenis_kegiatan'] = $post->jenis_kegiatan;
				$nestedData['nilai_dana'] = $post->nilai_dana;
				$nestedData['nsl_apbn_nsup'] = $post->nsl_apbn_nsup;
				$nestedData['nsl_apbn_nsup2'] = $post->nsl_apbn_nsup2;
				$nestedData['nsl_apbn_dir_pkp'] = $post->nsl_apbn_dir_pkp;
				$nestedData['nsl_apbn_dir_lain'] = $post->nsl_apbn_dir_lain;
				$nestedData['nsl_apbn_kl_lain'] = $post->nsl_apbn_kl_lain;
				$nestedData['nsl_apbd_prop'] = $post->nsl_apbd_prop;
				$nestedData['nsl_apbd_kota'] = $post->nsl_apbd_kota;
				$nestedData['nsl_dak'] = $post->nsl_dak;
				$nestedData['nsl_hibah'] = $post->nsl_hibah;
				$nestedData['nsl_non_gov'] = $post->nsl_non_gov;
				$nestedData['nsl_masyarakat'] = $post->nsl_masyarakat;
				$nestedData['nsl_lain'] = $post->nsl_lain;
				$nestedData['keterangan'] = $post->keterangan;
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
						if($item->kode_menu==120)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['376'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['377'])){
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

	public function select(Request $request)
	{
		if(!empty($request->input('prop'))){
			$kota = DB::select('select kode, nama from bkt_01010102_kota where kode_prop='.$request->input('prop'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('kota'))){
			$kota = DB::select('select b.* from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and kode_kota='.$request->input('kota'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('korkot'))){
			$kota = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('korkot'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('kec'))){
			$kota = DB::select('select * from bkt_01010123_kawasan where kode_kota='.$request->input('kec'));
			echo json_encode($kota);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==120)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			
			$kode_prop = DB::select('select kode, nama from bkt_01010101_prop');
			$data['kode_prop_list'] = $kode_prop;

			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['376'])){
				$rowData = DB::select('select * from bkt_01030206_plan_kaw_prior where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['nama_kmw'] = $rowData[0]->nama_kmw;
				$data['nama_kota'] = $rowData[0]->nama_kota;
				$data['nama_korkot'] = $rowData[0]->nama_korkot;
				$data['nama_kec'] = $rowData[0]->nama_kec;
				$data['nama_kel'] = $rowData[0]->nama_kel;
				$data['nama_faskel'] = $rowData[0]->nama_faskel;
				$data['tgl_transaksi'] = $rowData[0]->tgl_transaksi;
				$data['termin'] = $rowData[0]->termin;
				$data['jns_program'] = $rowData[0]->jns_program;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['nilai_dana'] = $rowData[0]->nilai_dana;
				$data['nsl_apbn_nsup'] = $rowData[0]->nsl_apbn_nsup;
				$data['nsl_apbn_nsup2'] = $rowData[0]->nsl_apbn_nsup2;
				$data['nsl_apbn_dir_pkp'] = $rowData[0]->nsl_apbn_dir_pkp;
				$data['nsl_apbn_dir_lain'] = $rowData[0]->nsl_apbn_dir_lain;
				$data['nsl_apbn_kl_lain'] = $rowData[0]->nsl_apbn_kl_lain;
				$data['nsl_apbd_prop'] = $rowData[0]->nsl_apbd_prop;
				$data['nsl_apbd_kota'] = $rowData[0]->nsl_apbd_kota;
				$data['nsl_dak'] = $rowData[0]->nsl_dak;
				$data['nsl_hibah'] = $rowData[0]->nsl_hibah;
				$data['nsl_non_gov'] = $rowData[0]->nsl_non_gov;
				$data['nsl_masyarakat'] = $rowData[0]->nsl_masyarakat;
				$data['nsl_lain'] = $rowData[0]->nsl_lain;
				$data['keterangan'] = $rowData[0]->keterangan;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop');
				if(!empty($rowData[0]->kode_prop))
					$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode_prop='.$rowData[0]->kode_prop);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kawasan_list']=DB::select('select * from bkt_01010123_kawasan where kode_kota='.$rowData[0]->kode_kota);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010408/create',$data);
			}else if ($data['kode']==null && !empty($data['detil']['375'])){
				$data['tahun'] = null;
				$data['nama_kmw'] = null;
				$data['nama_kota'] = null;
				$data['nama_korkot'] = null;
				$data['nama_kec'] = null;
				$data['nama_kel'] = null;
				$data['nama_faskel'] = null;
				$data['tgl_transaksi'] = null;
				$data['termin'] = null;
				$data['jns_program'] = null;
				$data['jenis_kegiatan'] = null;
				$data['nilai_dana'] = null;
				$data['nsl_apbn_nsup'] = null;
				$data['nsl_apbn_nsup2'] = null;
				$data['nsl_apbn_dir_pkp'] = null;
				$data['nsl_apbn_dir_lain'] = null;
				$data['nsl_apbn_kl_lain'] = null;
				$data['nsl_apbd_prop'] = null;
				$data['nsl_apbd_kota'] = null;
				$data['nsl_dak'] = null;
				$data['nsl_hibah'] = null;
				$data['nsl_non_gov'] = null;
				$data['nsl_masyarakat'] = null;
				$data['nsl_lain'] = null;
				$data['keterangan'] = null;
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
				$data['kode_kel_list'] = DB::select('select * from bkt_01010104_kel where status=1');
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_kawasan_list'] = DB::select('select * from bkt_01010123_kawasan');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010408/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{

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

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030206_plan_kaw_prior')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'tgl_transaksi' => $this->date_conversion($request->input('tgl_transaksi-input')),
				'termin' => $request->input('termin-input'),
				'jns_program' => $request->input('select-jns_program-input'),
				'jenis_kegiatan' => $request->input('select-jenis_kegiatan-input'),
				'nilai_dana' => $request->input('nilai_dana-input'),
				'nsl_apbn_nsup' => $request->input('nsl_apbn_nsup-input'),
				'nsl_apbn_nsup2' => $request->input('nsl_apbn_nsup2-input'),
				'nsl_apbn_dir_pkp' => $request->input('nsl_apbn_dir_pkp-input'),
				'nsl_apbn_dir_lain' => $request->input('nsl_apbn_dir_lain-input'),
				'nsl_apbn_kl_lain' => $request->input('nsl_apbn_kl_lain-input'),
				'nsl_apbd_prop' => $request->input('nsl_apbd_prop-input'),
				'nsl_apbd_kota' => $request->input('nsl_apbd_kota-input'),
				'nsl_dak' => $request->input('nsl_dak-input'),
				'nsl_hibah' => $request->input('nsl_hibah-input'),
				'nsl_non_gov' => $request->input('nsl_non_gov-input'),
				'nsl_masyarakat' => $request->input('nsl_masyarakat-input'),
				'nsl_lain' => $request->input('nsl_lain-input'),
				'keterangan' => $request->input('keterangan-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/pelaksanaan/kelurahan/pagu_pencairan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/pelaksanaan/kelurahan/pagu_pencairan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 376);

		}else{
			DB::table('bkt_01030206_plan_kaw_prior')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'tgl_transaksi' => $this->date_conversion($request->input('tgl_transaksi-input')),
				'termin' => $request->input('termin-input'),
				'jns_program' => $request->input('select-jns_program-input'),
				'jenis_kegiatan' => $request->input('select-jenis_kegiatan-input'),
				'nilai_dana' => $request->input('nilai_dana-input'),
				'nsl_apbn_nsup' => $request->input('nsl_apbn_nsup-input'),
				'nsl_apbn_nsup2' => $request->input('nsl_apbn_nsup2-input'),
				'nsl_apbn_dir_pkp' => $request->input('nsl_apbn_dir_pkp-input'),
				'nsl_apbn_dir_lain' => $request->input('nsl_apbn_dir_lain-input'),
				'nsl_apbn_kl_lain' => $request->input('nsl_apbn_kl_lain-input'),
				'nsl_apbd_prop' => $request->input('nsl_apbd_prop-input'),
				'nsl_apbd_kota' => $request->input('nsl_apbd_kota-input'),
				'nsl_dak' => $request->input('nsl_dak-input'),
				'nsl_hibah' => $request->input('nsl_hibah-input'),
				'nsl_non_gov' => $request->input('nsl_non_gov-input'),
				'nsl_masyarakat' => $request->input('nsl_masyarakat-input'),
				'nsl_lain' => $request->input('nsl_lain-input'),
				'keterangan' => $request->input('keterangan-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/pelaksanaan/kelurahan/pagu_pencairan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/pelaksanaan/kelurahan/pagu_pencairan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 375);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030206_plan_kaw_prior')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 377);
        return Redirect::to('/main/pelaksanaan/kelurahan/pagu_pencairan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 7,
				'kode_menu' => 119,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
