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
			61 => 'diser_tgl',
			62 => 'diser_oleh',
			63 => 'diket_tgl',
			64 => 'diket_oleh',
			65 => 'diver_tgl',
			66 => 'diver_oleh',
			67 => 'created_time',
			68 => 'created_by',
			69 => 'updated_time',
			70 => 'updated_by'
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
				$nestedData['jns_sumber_dana'] = $post->jns_sumber_dana;
				$nestedData['kode_parent'] = $post->kode_parent;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['kode_kawasan'] = $post->kode_kawasan;
				$nestedData['id_ksm'] = $post->id_ksm;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['tgl_realisasi'] = $post->tgl_realisasi;
				$nestedData['vol_realisasi'] = $post->vol_realisasi;
				$nestedData['satuan'] = $post->satuan;
				$nestedData['nb_a_pupr_bdi_kolab'] = $post->nb_a_pupr_bdi_kolab;
				$nestedData['nb_a_pupr_bdi_plbk'] = $post->nb_a_pupr_bdi_plbk;
				$nestedData['nb_a_pupr_bdi_lain'] = $post->nb_a_pupr_bdi_lain;
				$nestedData['nb_a_pupr_nsup2'] = $post->nb_a_pupr_nsup2;
				$nestedData['nb_a_pupr_dir_pkp'] = $post->nb_a_pupr_dir_pkp;
				$nestedData['nb_a_pupr_dir_pkp_lain'] = $post->nb_a_pupr_dir_pkp_lain;
				$nestedData['nb_apbn_kl_lain'] = $post->nb_apbn_kl_lain;
				$nestedData['nb_apbd_prop'] = $post->nb_apbd_prop;
				$nestedData['nb_apbd_kota'] = $post->nb_apbd_kota;
				$nestedData['nb_dak'] = $post->nb_dak;
				$nestedData['nb_hibah'] = $post->nb_hibah;
				$nestedData['nb_non_gov'] = $post->nb_non_gov
				$nestedData['nb_masyarakat'] = $post->nb_masyarakat;
				$nestedData['nb_lainnya'] = $post->nb_lainnya;
				$nestedData['progress_keuangan'] = $post->progress_keuangan;
				$nestedData['tpm_q_jiwa'] = $post->tpm_q_jiwa;
				$nestedData['tpm_q_jiwa_w'] = $post->tpm_q_jiwa_w;
				$nestedData['tpm_q_mbr'] = $post->tpm_q_mbr;
				$nestedData['tpm_q_kk'] = $post->tpm_q_kk;
				$nestedData['tpm_q_kk_miskin'] = $post->tpm_q_kk_miskin;
				$nestedData['tk_q_pekerja'] = $post->tk_q_pekerja;
				$nestedData['tk_q_pekerja_w'] = $post->tk_q_pekerja_w;
				$nestedData['tk_q_hok'] = $post->tk_q_hok;
				$nestedData['id_kpp'] = $post->id_kpp;
				$nestedData['kpp_flag_bgn_msh_ada'] = $post->kpp_flag_bgn_msh_ada;
				$nestedData['kpp_flag_bgn_msh_baik'] = $post->kpp_flag_bgn_msh_baik;
				$nestedData['kpp_flag_bgn_msh_fungsi'] = $post->kpp_flag_bgn_msh_fungsi;
				$nestedData['kpp_flag_bgn_msh_man'] = $post->kpp_flag_bgn_msh_man;
				$nestedData['kpp_flag_bgn_msh_dev'] = $post->kpp_flag_bgn_msh_dev;
				$nestedData['hasil_sertifikasi'] = $post->hasil_sertifikasi;
				$nestedData['longitude'] = $post->longitude;
				$nestedData['latitude'] = $post->latitude;
				$nestedData['flag_foto_prcn0'] = $post->flag_foto_prcn0;
				$nestedData['url_img_prcn0'] = $post->url_img_prcn0;
				$nestedData['flag_foto_prcn50'] = $post->flag_foto_prcn50;
				$nestedData['url_img_prcn50'] = $post->url_img_prcn50;
				$nestedData['kpp_flag_bgn_msh_dev'] = $post->kpp_flag_bgn_msh_dev;
				$nestedData['flag_foto_prcn100'] = $post->flag_foto_prcn100;
				$nestedData['url_img_prcn100'] = $post->url_img_prcn100;
				$nestedData['pencairan_dana1'] = $post->pencairan_dana1;
				$nestedData['pencairan_dana2'] = $post->pencairan_dana2;
				$nestedData['pencairan_dana3'] = $post->pencairan_dana3;
				$nestedData['pemanfaatan_dana'] = $post->pemanfaatan_dana;
				$nestedData['pemanfaatan_dana_prcn'] = $post->pemanfaatan_dana_prcn;
				$nestedData['progress_fisik'] = $post->progress_fisik;
				$nestedData['flag_sudah_sertias'] = $post->flag_sudah_sertias;
				$nestedData['tgl_sertias'] = $post->tgl_sertias;
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
				$data['jns_sumber_dana'] = $rowData[0]->jns_sumber_dana;
				$data['kode_parent'] = $rowData[0]->kode_parent;
				$data['nama_kmw'] = $rowData[0]->nama_kmw;
				$data['nama_kota'] = $rowData[0]->nama_kota;
				$data['nama_korkot'] = $rowData[0]->nama_korkot;
				$data['nama_kec'] = $rowData[0]->nama_kec;
				$data['nama_kel'] = $rowData[0]->nama_kel;
				$data['nama_faskel'] = $rowData[0]->nama_faskel;
				$data['kode_kawasan'] = $rowData[0]->kode_kawasan;
				$data['id_ksm'] = $rowData[0]->id_ksm;
				$data['tahun'] = $rowData[0]->tahun;
				$data['tgl_realisasi'] = $rowData[0]->tgl_realisasi;
				$data['vol_realisasi'] = $rowData[0]->vol_realisasi;
				$data['satuan'] = $rowData[0]->satuan;
				$data['nb_a_pupr_bdi_kolab'] = $rowData[0]->nb_a_pupr_bdi_kolab;
				$data['nb_a_pupr_bdi_plbk'] = $rowData[0]->nb_a_pupr_bdi_plbk;
				$data['nb_a_pupr_bdi_lain'] = $rowData[0]->nb_a_pupr_bdi_lain;
				$data['nb_a_pupr_nsup2'] = $rowData[0]->nb_a_pupr_nsup2;
				$data['nb_a_pupr_dir_pkp'] = $rowData[0]->nb_a_pupr_dir_pkp;
				$data['nb_a_pupr_dir_pkp_lain'] = $rowData[0]->nb_a_pupr_dir_pkp_lain;
				$data['nb_apbn_kl_lain'] = $rowData[0]->nb_apbn_kl_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;
				$data['nb_dak'] = $rowData[0]->nb_dak;
				$data['nb_hibah'] = $rowData[0]->nb_hibah;
				$data['nb_non_gov'] = $rowData[0]->nb_non_gov
				$data['nb_masyarakat'] = $rowData[0]->nb_masyarakat;
				$data['nb_lainnya'] = $rowData[0]->nb_lainnya;
				$data['progress_keuangan'] = $rowData[0]->progress_keuangan;
				$data['tpm_q_jiwa'] = $rowData[0]->tpm_q_jiwa;
				$data['tpm_q_jiwa_w'] = $rowData[0]->tpm_q_jiwa_w;
				$data['tpm_q_mbr'] = $rowData[0]->tpm_q_mbr;
				$data['tpm_q_kk'] = $rowData[0]->tpm_q_kk;
				$data['tpm_q_kk_miskin'] = $rowData[0]->tpm_q_kk_miskin;
				$data['tk_q_pekerja'] = $rowData[0]->tk_q_pekerja;
				$data['tk_q_pekerja_w'] = $rowData[0]->tk_q_pekerja_w;
				$data['tk_q_hok'] = $rowData[0]->tk_q_hok;
				$data['id_kpp'] = $rowData[0]->id_kpp;
				$data['kpp_flag_bgn_msh_ada'] = $rowData[0]->kpp_flag_bgn_msh_ada;
				$data['kpp_flag_bgn_msh_baik'] = $rowData[0]->kpp_flag_bgn_msh_baik;
				$data['kpp_flag_bgn_msh_fungsi'] = $rowData[0]->kpp_flag_bgn_msh_fungsi;
				$data['kpp_flag_bgn_msh_man'] = $rowData[0]->kpp_flag_bgn_msh_man;
				$data['kpp_flag_bgn_msh_dev'] = $rowData[0]->kpp_flag_bgn_msh_dev;
				$data['hasil_sertifikasi'] = $rowData[0]->hasil_sertifikasi;
				$data['longitude'] = $rowData[0]->longitude;
				$data['latitude'] = $rowData[0]->latitude;
				$data['flag_foto_prcn0'] = $rowData[0]->flag_foto_prcn0;
				$data['url_img_prcn0'] = $rowData[0]->url_img_prcn0;
				$data['flag_foto_prcn50'] = $rowData[0]->flag_foto_prcn50;
				$data['url_img_prcn50'] = $rowData[0]->url_img_prcn50;
				$data['kpp_flag_bgn_msh_dev'] = $rowData[0]->kpp_flag_bgn_msh_dev;
				$data['flag_foto_prcn100'] = $rowData[0]->flag_foto_prcn100;
				$data['url_img_prcn100'] = $rowData[0]->url_img_prcn100;
				$data['pencairan_dana1'] = $rowData[0]->pencairan_dana1;
				$data['pencairan_dana2'] = $rowData[0]->pencairan_dana2;
				$data['pencairan_dana3'] = $rowData[0]->pencairan_dana3;
				$data['pemanfaatan_dana'] = $rowData[0]->pemanfaatan_dana;
				$data['pemanfaatan_dana_prcn'] = $rowData[0]->pemanfaatan_dana_prcn;
				$data['progress_fisik'] = $rowData[0]->progress_fisik;
				$data['flag_sudah_sertias'] = $rowData[0]->flag_sudah_sertias;
				$data['tgl_sertias'] = $rowData[0]->tgl_sertias;
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
				$data['jns_sumber_dana'] = null;
				$data['kode_parent'] = null;
				$data['nama_kmw'] = null;
				$data['nama_kota'] = null;
				$data['nama_korkot'] = null;
				$data['nama_kec'] = null;
				$data['nama_kel'] = null;
				$data['nama_faskel'] = null;
				$data['kode_kawasan'] = null;
				$data['id_ksm'] = null;
				$data['tahun'] = null;
				$data['tgl_realisasi'] = null;
				$data['vol_realisasi'] = null;
				$data['satuan'] = null;
				$data['nb_a_pupr_bdi_kolab'] = null;
				$data['nb_a_pupr_bdi_plbk'] = null;
				$data['nb_a_pupr_bdi_lain'] = null;
				$data['nb_a_pupr_nsup2'] = null;
				$data['nb_a_pupr_dir_pkp'] = null;
				$data['nb_a_pupr_dir_pkp_lain'] = null;
				$data['nb_apbn_kl_lain'] = null;
				$data['nb_apbd_prop'] = null;
				$data['nb_apbd_kota'] = null;
				$data['nb_dak'] = null;
				$data['nb_hibah'] = null;
				$data['nb_non_gov'] = null;
				$data['nb_masyarakat'] = null;
				$data['nb_lainnya'] = null;
				$data['progress_keuangan'] = null;
				$data['tpm_q_jiwa'] = null;
				$data['tpm_q_jiwa_w'] = null;
				$data['tpm_q_mbr'] = null;
				$data['tpm_q_kk'] = null;
				$data['tpm_q_kk_miskin'] = null;
				$data['tk_q_pekerja'] = null;
				$data['tk_q_pekerja_w'] = null;
				$data['tk_q_hok'] = null;
				$data['id_kpp'] = null;
				$data['kpp_flag_bgn_msh_ada'] = null;
				$data['kpp_flag_bgn_msh_baik'] = null;
				$data['kpp_flag_bgn_msh_fungsi'] = null;
				$data['kpp_flag_bgn_msh_man'] = null;
				$data['kpp_flag_bgn_msh_dev'] = null;
				$data['hasil_sertifikasi'] = null;
				$data['longitude'] = null;
				$data['latitude'] = null;
				$data['flag_foto_prcn0'] = null;
				$data['url_img_prcn0'] = null;
				$data['flag_foto_prcn50'] = null;
				$data['url_img_prcn50'] = null;
				$data['kpp_flag_bgn_msh_dev'] = null;
				$data['flag_foto_prcn100'] = null;
				$data['url_img_prcn100'] = null;
				$data['pencairan_dana1'] = null;
				$data['pencairan_dana2'] = null;
				$data['pencairan_dana3'] = null;
				$data['pemanfaatan_dana'] = null;
				$data['pemanfaatan_dana_prcn'] = null;
				$data['progress_fisik'] = null;
				$data['flag_sudah_sertias'] = null;
				$data['tgl_sertias'] = null;
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
			->update([
				'jns_sumber_dana' => $request->input('select-jns_sumber_dana-input'),
				'kode_parent' => $request->input('select-kode_parent-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'kode_kawasan' => $request->input('select-kode_kawasan-input'),
				'id_ksm' => $request->input('select-id_ksm-input'),
				'tahun' => $request->input('tahun-input'),
				'tgl_realisasi' => $this->date_conversion($request->input('tgl_realisasi-input')),
				'vol_realisasi' => $request->input('vol_realisasi-input'),
				'satuan' => $request->input('satuan-input'),
				'nb_a_pupr_bdi_kolab' => $request->input('nb_a_pupr_bdi_kolab-input'),
				'nb_a_pupr_bdi_plbk' => $request->input('nb_a_pupr_bdi_plbk-input'),
				'nb_a_pupr_bdi_lain' => $request->input('nb_a_pupr_bdi_lain-input'),
				'nb_a_pupr_nsup2' => $request->input('nb_a_pupr_nsup2-input'),
				'nb_a_pupr_dir_pkp' => $request->input('nb_a_pupr_dir_pkp-input'),
				'nb_a_pupr_dir_pkp_lain' => $request->input('nb_a_pupr_dir_pkp_lain-input'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_dak' => $request->input('nb_dak-input'),
				'nb_hibah' => $request->input('nb_hibah-input'),
				'nb_non_gov' => $request->input('nb_non_gov-input'),
				'nb_masyarakat' => $request->input('nb_masyarakat-input'),
				'nb_lainnya' => $request->input('nb_lainnya-input'),
				'progress_keuangan' => $request->input('progress_keuangan-input'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
				'tk_q_pekerja' => $request->input('tk_q_pekerja-input'),
				'tk_q_pekerja_w' => $request->input('tk_q_pekerja_w-input'),
				'tk_q_hok' => $request->input('tk_q_hok-input'),
				'tk_val_hok' => $request->input('tk_val_hok-input'),
				'id_kpp' => $request->input('id_kpp-input'),
				'kpp_flag_bgn_msh_ada' => $request->input('kpp_flag_bgn_msh_ada-input'),
				'kpp_flag_bgn_msh_baik' => $request->input('kpp_flag_bgn_msh_baik-input'),
				'kpp_flag_bgn_msh_fungsi' => $request->input('kpp_flag_bgn_msh_fungsi-input'),
				'kpp_flag_bgn_msh_man' => $request->input('kpp_flag_bgn_msh_man-input'),
				'kpp_flag_bgn_msh_dev' => $request->input('kpp_flag_bgn_msh_dev-input'),
				'hasil_sertifikasi' => $request->input('hasil_sertifikasi-input'),
				'longitude' => $request->input('longitude-input'),
				'latitude' => $request->input('latitude-input'),
				'flag_foto_prcn0' => $request->input('flag_foto_prcn0-input'),
				'url_img_prcn0' => $request->input('url_img_prcn0-input'),
				'flag_foto_prcn50' => $request->input('flag_foto_prcn50-input'),
				'url_img_prcn50' => $request->input('url_img_prcn50-input'),
				'flag_foto_prcn100' => $request->input('flag_foto_prcn100-input'),
				'url_img_prcn100' => $request->input('pencairan_dana1-input'),
				'pencairan_dana1' => $request->input('pencairan_dana2-input'),
				'pencairan_dana2' => $request->input('pencairan_dana3-input'),
				'pencairan_dana3' => $request->input('id_kpp-input'),
				'pemanfaatan_dana' => $request->input('pemanfaatan_dana-input'),
				'pemanfaatan_dana_prcn' => $request->input('pemanfaatan_dana_prcn-input'),
				'progress_fisik' => $request->input('progress_fisik-input'),
				'flag_sudah_sertias' => $request->input('flag_sudah_sertias-input'),
				'tgl_sertias' => $request->input('tgl_sertias-input'),
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
				'jns_sumber_dana' => $request->input('select-jns_sumber_dana-input'),
				'kode_parent' => $request->input('select-kode_parent-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'kode_kawasan' => $request->input('select-kode_kawasan-input'),
				'id_ksm' => $request->input('select-id_ksm-input'),
				'tahun' => $request->input('tahun-input'),
				'tgl_realisasi' => $this->date_conversion($request->input('tgl_realisasi-input')),
				'vol_realisasi' => $request->input('vol_realisasi-input'),
				'satuan' => $request->input('satuan-input'),
				'nb_a_pupr_bdi_kolab' => $request->input('nb_a_pupr_bdi_kolab-input'),
				'nb_a_pupr_bdi_plbk' => $request->input('nb_a_pupr_bdi_plbk-input'),
				'nb_a_pupr_bdi_lain' => $request->input('nb_a_pupr_bdi_lain-input'),
				'nb_a_pupr_nsup2' => $request->input('nb_a_pupr_nsup2-input'),
				'nb_a_pupr_dir_pkp' => $request->input('nb_a_pupr_dir_pkp-input'),
				'nb_a_pupr_dir_pkp_lain' => $request->input('nb_a_pupr_dir_pkp_lain-input'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_dak' => $request->input('nb_dak-input'),
				'nb_hibah' => $request->input('nb_hibah-input'),
				'nb_non_gov' => $request->input('nb_non_gov-input'),
				'nb_masyarakat' => $request->input('nb_masyarakat-input'),
				'nb_lainnya' => $request->input('nb_lainnya-input'),
				'progress_keuangan' => $request->input('progress_keuangan-input'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
				'tk_q_pekerja' => $request->input('tk_q_pekerja-input'),
				'tk_q_pekerja_w' => $request->input('tk_q_pekerja_w-input'),
				'tk_q_hok' => $request->input('tk_q_hok-input'),
				'tk_val_hok' => $request->input('tk_val_hok-input'),
				'id_kpp' => $request->input('id_kpp-input'),
				'kpp_flag_bgn_msh_ada' => $request->input('kpp_flag_bgn_msh_ada-input'),
				'kpp_flag_bgn_msh_baik' => $request->input('kpp_flag_bgn_msh_baik-input'),
				'kpp_flag_bgn_msh_fungsi' => $request->input('kpp_flag_bgn_msh_fungsi-input'),
				'kpp_flag_bgn_msh_man' => $request->input('kpp_flag_bgn_msh_man-input'),
				'kpp_flag_bgn_msh_dev' => $request->input('kpp_flag_bgn_msh_dev-input'),
				'hasil_sertifikasi' => $request->input('hasil_sertifikasi-input'),
				'longitude' => $request->input('longitude-input'),
				'latitude' => $request->input('latitude-input'),
				'flag_foto_prcn0' => $request->input('flag_foto_prcn0-input'),
				'url_img_prcn0' => $request->input('url_img_prcn0-input'),
				'flag_foto_prcn50' => $request->input('flag_foto_prcn50-input'),
				'url_img_prcn50' => $request->input('url_img_prcn50-input'),
				'flag_foto_prcn100' => $request->input('flag_foto_prcn100-input'),
				'url_img_prcn100' => $request->input('pencairan_dana1-input'),
				'pencairan_dana1' => $request->input('pencairan_dana2-input'),
				'pencairan_dana2' => $request->input('pencairan_dana3-input'),
				'pencairan_dana3' => $request->input('id_kpp-input'),
				'pemanfaatan_dana' => $request->input('pemanfaatan_dana-input'),
				'pemanfaatan_dana_prcn' => $request->input('pemanfaatan_dana_prcn-input'),
				'progress_fisik' => $request->input('progress_fisik-input'),
				'flag_sudah_sertias' => $request->input('flag_sudah_sertias-input'),
				'tgl_sertias' => $request->input('tgl_sertias-input'),
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
				'kode_menu' => 120,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
