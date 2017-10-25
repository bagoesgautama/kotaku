<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010406Controller extends Controller
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
				if($item->kode_menu==118)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 366);
				return view('MAIN/bk010406/index',$data);
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
		if(!empty($request->input('kmw'))){
			$kota = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
			echo json_encode($kota);
		}
		if(!empty($request->input('kota_korkot'))){
			$korkot = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$request->input('kota_korkot'));
			echo json_encode($korkot);
		}
		if(!empty($request->input('kota_kec'))){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kota_kec'));
			echo json_encode($kec);
		}
		if(!empty($request->input('kec_kel'))){
			$kel = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kec_kel'));
			echo json_encode($kel);
		}
		if(!empty($request->input('kel_faskel'))){
			$faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$request->input('kel_faskel'));
			echo json_encode($faskel);
		}
		if(!empty($request->input('kota_kawasan'))){
			$kmw = DB::select('select b.id, b.kode_kawasan, b.nama from bkt_01010102_kota a, bkt_01010123_kawasan b where b.kode_kota=a.kode and b.kode_kota='.$request->input('kota_kawasan'));
			echo json_encode($kmw);
		}
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'jns_sumber_dana',
			1 =>'hasil_sertifikasi',
			2 =>'kode_kmw',
			3 =>'kode_kota',
			4 =>'kode_korkot',
			5 =>'kode_kawasan',
			6 =>'id_kpp',
			7 =>'tahun',
			8 =>'tgl_realisasi',
			9 =>'vol_realisasi',
			10 =>'satuan',
			11 =>'created_time'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kmw, e.nama nama_kawasan, g.nama nama_kpp
			from bkt_01040202_real_ktrk_krj a 
				left join bkt_01010102_kota b on b.kode=a.kode_kota 
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot 
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010129_kpp g on g.id=a.id_kpp
			where
				a.jns_sumber_dana=2';
		$totalData = DB::select('select count(1) cnt from bkt_01040202_real_ktrk_krj a 
				left join bkt_01010102_kota b on b.kode=a.kode_kota 
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot 
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010129_kpp g on g.id=a.id_kpp
			where
				a.jns_sumber_dana=2');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by a.'.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and (a.jns_sumber_dana like "%'.$search.'%" or a.hasil_sertifikasi like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or a.tahun like "%'.$search.'%" or a.tgl_realisasi like "%'.$search.'%" or a.vol_realisasi like "%'.$search.'%" or a.satuan like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.jns_sumber_dana like "%'.$search.'%" or a.hasil_sertifikasi like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or a.tahun like "%'.$search.'%" or a.tgl_realisasi like "%'.$search.'%" or a.vol_realisasi like "%'.$search.'%" or a.satuan like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$jns_sumber_dana = null;

				if($post->jns_sumber_dana == '1'){
					$jns_sumber_dana = 'BDI / Non BDI';
				}elseif($post->jns_sumber_dana == '2'){
					$jns_sumber_dana = 'Non BDI Kolaborasi';
				}

				$url_edit=url('/')."/main/pelaksanaan/kota_non/sertifikasi_infra/create?kode=".$edit;
				$url_delete=url('/')."/main/pelaksanaan/kota_non/sertifikasi_infra/delete?kode=".$delete;
				$nestedData['jns_sumber_dana'] = $jns_sumber_dana;
				$nestedData['hasil_sertifikasi'] = $post->hasil_sertifikasi;
				$nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_kawasan'] = $post->nama_kawasan;
				$nestedData['id_kpp'] = $post->nama_kpp;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['tgl_realisasi'] = $post->tgl_realisasi;
				$nestedData['vol_realisasi'] = $post->vol_realisasi;
				$nestedData['satuan'] = $post->satuan;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==118)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['368'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['369'])){
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
				if($item->kode_menu==118)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['368'])){
				$rowData = DB::select('select * from bkt_01040202_real_ktrk_krj where kode='.$data['kode']);
				$data['jns_sumber_dana'] = $rowData[0]->jns_sumber_dana;
				$data['kode_parent'] = $rowData[0]->kode_parent;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kawasan'] = $rowData[0]->kode_kawasan;
				$data['tahun'] = $rowData[0]->tahun;
				$data['tgl_realisasi'] = $rowData[0]->tgl_realisasi;
				$data['vol_realisasi'] = $rowData[0]->vol_realisasi;
				$data['satuan'] = $rowData[0]->satuan;
				$data['progress_keg'] = $rowData[0]->progress_keg;
				$data['nb_apbn_nsup'] = $rowData[0]->nb_apbn_nsup;
				$data['nb_apbn_lain'] = $rowData[0]->nb_apbn_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;
				$data['nb_lainnya'] = $rowData[0]->nb_lainnya;
				$data['progress_keuangan'] = $rowData[0]->progress_keuangan;
				$data['tpm_q_jiwa'] = $rowData[0]->tpm_q_jiwa;
				$data['tpm_q_jiwa_w'] = $rowData[0]->tpm_q_jiwa_w;
				$data['tpm_q_mbr'] = $rowData[0]->tpm_q_mbr;
				$data['tpm_q_kk'] = $rowData[0]->tpm_q_kk;
				$data['tpm_q_kk_miskin'] = $rowData[0]->tpm_q_kk_miskin;
				$data['tk_q_tkp'] = $rowData[0]->tk_q_tkp;
				$data['tk_q_tkw'] = $rowData[0]->tk_q_tkw;
				$data['tk_q_hok'] = $rowData[0]->tk_q_hok;
				$data['tk_q_nilai_hok'] = $rowData[0]->tk_q_nilai_hok;
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
				$data['flag_foto_prcn100'] = $rowData[0]->flag_foto_prcn100;
				$data['url_img_prcn100'] = $rowData[0]->url_img_prcn100;
				$data['pencairan_dana1'] = $rowData[0]->pencairan_dana1;
				$data['pencairan_dana2'] = $rowData[0]->pencairan_dana2;
				$data['pencairan_dana3'] = $rowData[0]->pencairan_dana3;
				$data['pemanfaatan_dana'] = $rowData[0]->pemanfaatan_dana;
				$data['pemanfaatan_data_prcn'] = $rowData[0]->pemanfaatan_data_prcn;
				$data['progres_fisik'] = $rowData[0]->progres_fisik;
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
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kawasan_list']=DB::select('select b.id, b.kode_kawasan, b.nama from bkt_01010102_kota a, bkt_01010123_kawasan b where b.kode_kota=a.kode and b.kode_kota='.$rowData[0]->kode_kota);
				$data['kode_kpp_list'] = DB::select('select * from bkt_01010129_kpp where id='.$rowData[0]->id_kpp);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010406/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['367'])){
				$data['jns_sumber_dana'] = 2;
				$data['kode_parent'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['kode_kawasan'] = null;
				$data['tahun'] = null;
				$data['tgl_realisasi'] = null;
				$data['vol_realisasi'] = null;
				$data['satuan'] = null;
				$data['progress_keg'] = null;
				$data['nb_apbn_nsup'] = null;
				$data['nb_apbn_lain'] = null;
				$data['nb_apbd_prop'] = null;
				$data['nb_apbd_kota'] = null;
				$data['nb_lainnya'] = null;
				$data['progress_keuangan'] = null;
				$data['tpm_q_jiwa'] = null;
				$data['tpm_q_jiwa_w'] = null;
				$data['tpm_q_mbr'] = null;
				$data['tpm_q_kk'] = null;
				$data['tpm_q_kk_miskin'] = null;
				$data['tk_q_tkp'] = null;
				$data['tk_q_tkw'] = null;
				$data['tk_q_hok'] = null;
				$data['tk_q_nilai_hok'] = null;
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
				$data['flag_foto_prcn100'] = null;
				$data['url_img_prcn100'] = null;
				$data['pencairan_dana1'] = null;
				$data['pencairan_dana2'] = null;
				$data['pencairan_dana3'] = null;
				$data['pemanfaatan_dana'] = null;
				$data['pemanfaatan_data_prcn'] = null;
				$data['progres_fisik'] =null;
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
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_kawasan_list'] = DB::select('select * from bkt_01010123_kawasan');
				$data['kode_kpp_list'] = DB::select('select * from bkt_01010129_kpp where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user'); 
				return view('MAIN/bk010406/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$file_prcn0 = $request->file('url_img_prcn0');
		$url_prcn0 = null;
		$upload_prcn0 = false;
		if($request->input('uploaded-url_img_prcn0') != null && $file_prcn0 == null){
			$url_prcn0 = $request->input('uploaded-url_img_prcn0');
			$upload_prcn0 = false;
		}elseif($request->input('uploaded-url_img_prcn0') != null && $file_prcn0 != null){
			$url_prcn0 = $file_prcn0->getClientOriginalName();
			$upload_prcn0 = true;
		}elseif($request->input('uploaded-url_img_prcn0') == null && $file_prcn0 != null){
			$url_prcn0 = $file_prcn0->getClientOriginalName();
			$upload_prcn0 = true;
		}

		$file_prcn50 = $request->file('url_img_prcn50');
		$url_prcn50 = null;
		$upload_prcn50 = false;
		if($request->input('uploaded-url_img_prcn50') != null && $file_prcn50 == null){
			$url_prcn50 = $request->input('uploaded-url_img_prcn50');
			$upload_prcn50 = false;
		}elseif($request->input('uploaded-url_img_prcn50') != null && $file_prcn50 != null){
			$url_prcn50 = $file_prcn50->getClientOriginalName();
			$upload_prcn50 = true;
		}elseif($request->input('uploaded-url_img_prcn50') == null && $file_prcn50 != null){
			$url_prcn50 = $file_prcn50->getClientOriginalName();
			$upload_prcn50 = true;
		}

		$file_prcn100 = $request->file('url_img_prcn100');
		$url_prcn100 = null;
		$upload_prcn100 = false;
		if($request->input('uploaded-url_img_prcn100') != null && $file_prcn100 == null){
			$url_prcn100 = $request->input('uploaded-url_img_prcn100');
			$upload_prcn100 = false;
		}elseif($request->input('uploaded-url_img_prcn100') != null && $file_prcn100 != null){
			$url_prcn100 = $file_prcn100->getClientOriginalName();
			$upload_prcn100 = true;
		}elseif($request->input('uploaded-url_img_prcn100') == null && $file_prcn100 != null){
			$url_prcn100 = $file_prcn100->getClientOriginalName();
			$upload_prcn100 = true;
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01040202_real_ktrk_krj')->where('kode', $request->input('kode'))
			->update([
				'jns_sumber_dana' => $request->input('jns_sumber_dana'),
				'kode_parent' => $request->input('kode-parent-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'kode_kawasan' => $request->input('kode-kawasan-input'),
				'tahun' => $request->input('tahun-input'),
				'tgl_realisasi' => $request->input('tgl_realisasi'),
				'vol_realisasi' => $request->input('vol_realisasi'),
				'satuan' => $request->input('satuan'),
				'progress_keg' => $request->input('progress_keg'),
				'nb_apbn_nsup' => $request->input('nb_apbn_nsup'),
				'nb_apbn_lain' => $request->input('nb_apbn_lain'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota'),
				'nb_lainnya' => $request->input('nb_lainnya'),
				'progress_keuangan' => $request->input('progress_keuangan'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr'),
				'tpm_q_kk' => $request->input('tpm_q_kk'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin'),
				'tk_q_tkp' => $request->input('tk_q_tkp'),
				'tk_q_tkw' => $request->input('tk_q_tkw'),
				'tk_q_hok' => $request->input('tk_q_hok'),
				'tk_q_nilai_hok' => $request->input('tk_q_nilai_hok'),
				'id_kpp' => $request->input('id_kpp'),
				'kpp_flag_bgn_msh_ada' => intval($request->input('kpp_flag_bgn_msh_ada')),
				'kpp_flag_bgn_msh_baik' => intval($request->input('kpp_flag_bgn_msh_baik')),
				'kpp_flag_bgn_msh_fungsi' => intval($request->input('kpp_flag_bgn_msh_fungsi')),
				'kpp_flag_bgn_msh_man' => intval($request->input('kpp_flag_bgn_msh_man')),
				'kpp_flag_bgn_msh_dev' => intval($request->input('kpp_flag_bgn_msh_dev')),
				'hasil_sertifikasi' => $request->input('hasil_sertifikasi'),
				'longitude' => $request->input('longitude'),
				'latitude' => $request->input('latitude'),
				'flag_foto_prcn0' => intval($request->input('flag_foto_prcn0')),
				'url_img_prcn0' => $url_prcn0,
				'flag_foto_prcn50' => intval($request->input('flag_foto_prcn50')),
				'url_img_prcn50' => $url_prcn50,
				'flag_foto_prcn100' => intval($request->input('flag_foto_prcn100')),
				'url_img_prcn100' => $url_prcn100,
				'pencairan_dana1' => $request->input('pencairan_dana1'),
				'pencairan_dana2' => $request->input('pencairan_dana2'),
				'pencairan_dana3' => $request->input('pencairan_dana3'),
				'pemanfaatan_dana' => $request->input('pemanfaatan_dana'),
				'pemanfaatan_data_prcn' => $request->input('pemanfaatan_data_prcn'),
				'progres_fisik' => $request->input('progres_fisik'),
				'flag_sudah_sertias' => $request->input('flag_sudah_sertias'),
				'tgl_sertias' => $request->input('tgl_sertias'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_prcn0 == true){
				$file_prcn0->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_kota_non_BDI_kolaborasi/sertifikasi_infrastruktur'), $file_prcn0->getClientOriginalName());
			}

			if($upload_prcn50 == true){
				$file_prcn50->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_kota_non_BDI_kolaborasi/sertifikasi_infrastruktur'), $file_prcn50->getClientOriginalName());
			}

			if($upload_prcn100 == true){
				$file_prcn100->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_kota_non_BDI_kolaborasi/sertifikasi_infrastruktur'), $file_prcn100->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 368);

		}else{
			DB::table('bkt_01040202_real_ktrk_krj')->insert([
				'jns_sumber_dana' => $request->input('jns_sumber_dana'),
				'kode_parent' => $request->input('kode-parent-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'kode_kawasan' => $request->input('kode-kawasan-input'),
				'tahun' => $request->input('tahun-input'),
				'tgl_realisasi' => $request->input('tgl_realisasi'),
				'vol_realisasi' => $request->input('vol_realisasi'),
				'satuan' => $request->input('satuan'),
				'progress_keg' => $request->input('progress_keg'),
				'nb_apbn_nsup' => $request->input('nb_apbn_nsup'),
				'nb_apbn_lain' => $request->input('nb_apbn_lain'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota'),
				'nb_lainnya' => $request->input('nb_lainnya'),
				'progress_keuangan' => $request->input('progress_keuangan'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr'),
				'tpm_q_kk' => $request->input('tpm_q_kk'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin'),
				'tk_q_tkp' => $request->input('tk_q_tkp'),
				'tk_q_tkw' => $request->input('tk_q_tkw'),
				'tk_q_hok' => $request->input('tk_q_hok'),
				'tk_q_nilai_hok' => $request->input('tk_q_nilai_hok'),
				'id_kpp' => $request->input('id_kpp'),
				'kpp_flag_bgn_msh_ada' => intval($request->input('kpp_flag_bgn_msh_ada')),
				'kpp_flag_bgn_msh_baik' => intval($request->input('kpp_flag_bgn_msh_baik')),
				'kpp_flag_bgn_msh_fungsi' => intval($request->input('kpp_flag_bgn_msh_fungsi')),
				'kpp_flag_bgn_msh_man' => intval($request->input('kpp_flag_bgn_msh_man')),
				'kpp_flag_bgn_msh_dev' => intval($request->input('kpp_flag_bgn_msh_dev')),
				'hasil_sertifikasi' => $request->input('hasil_sertifikasi'),
				'longitude' => $request->input('longitude'),
				'latitude' => $request->input('latitude'),
				'flag_foto_prcn0' => intval($request->input('flag_foto_prcn0')),
				'url_img_prcn0' => $url_prcn0,
				'flag_foto_prcn50' => intval($request->input('flag_foto_prcn50')),
				'url_img_prcn50' => $url_prcn50,
				'flag_foto_prcn100' => intval($request->input('flag_foto_prcn100')),
				'url_img_prcn100' => $url_prcn100,
				'pencairan_dana1' => $request->input('pencairan_dana1'),
				'pencairan_dana2' => $request->input('pencairan_dana2'),
				'pencairan_dana3' => $request->input('pencairan_dana3'),
				'pemanfaatan_dana' => $request->input('pemanfaatan_dana'),
				'pemanfaatan_data_prcn' => $request->input('pemanfaatan_data_prcn'),
				'progres_fisik' => $request->input('progres_fisik'),
				'flag_sudah_sertias' => $request->input('flag_sudah_sertias'),
				'tgl_sertias' => $request->input('tgl_sertias'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_prcn0 == true){
				$file_prcn0->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_kota_non_BDI_kolaborasi/sertifikasi_infrastruktur'), $file_prcn0->getClientOriginalName());
			}

			if($upload_prcn50 == true){
				$file_prcn50->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_kota_non_BDI_kolaborasi/sertifikasi_infrastruktur'), $file_prcn50->getClientOriginalName());
			}

			if($upload_prcn100 == true){
				$file_prcn100->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_kota_non_BDI_kolaborasi/sertifikasi_infrastruktur'), $file_prcn100->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 367);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01040202_real_ktrk_krj')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 369);
        return Redirect::to('/main/pelaksanaan/kota_non/sertifikasi_infra');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 7,
				'kode_menu' => 118,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
