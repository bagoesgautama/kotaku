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
			0 => 'kode_parent',
			1 => 'jns_sumber_dana',
			2 => 'kode_kel',
			3 => 'kode_faskel',
			4 => 'kode_kawasan',
			5 => 'id_ksm',
			6 => 'tahun',
			7 => 'created_time'
		);
		$query='
			select 
				a.*, 
				b.nama nama_kel,
				c.nama nama_faskel,
				d.nama nama_kawasan,
				e.nama nama_ksm,
				a.jenis_komponen_keg real_komponen,
				f.jenis_komponen_keg usulan_komponen,
				g.nama nama_subkomponen,
				h.nama nama_dtl_subkomponen
			from bkt_01040201_real_keg a
				left join bkt_01010104_kel b on b.kode=a.kode_kel
				left join bkt_01010113_faskel c on c.kode=a.kode_faskel
				left join bkt_01010123_kawasan d on d.id=a.kode_kawasan
				left join bkt_01010128_ksm e on e.id=a.id_ksm
				left join bkt_01030208_usulan_keg_kt f on a.kode_parent=f.kode
				left join bkt_01010120_subkomponen g on (g.id=f.id_subkomponen or g.id=a.id_subkomponen)
				left join bkt_01010121_dtl_subkomponen h on (h.id=f.id_dtl_subkomponen or h.id=a.id_dtl_subkomponen)
			where
				a.jns_sumber_dana=1 and a.skala_kegiatan=2';
		$totalData = DB::select('select count(1) cnt from bkt_01040201_real_keg a
				left join bkt_01010104_kel b on b.kode=a.kode_kel
				left join bkt_01010113_faskel c on c.kode=a.kode_faskel
				left join bkt_01010123_kawasan d on d.id=a.kode_kawasan
				left join bkt_01010128_ksm e on e.id=a.id_ksm
				left join bkt_01030208_usulan_keg_kt f on a.kode_parent=f.kode
				left join bkt_01010120_subkomponen g on (g.id=f.id_subkomponen or g.id=a.id_subkomponen)
				left join bkt_01010121_dtl_subkomponen h on (h.id=f.id_dtl_subkomponen or h.id=a.id_dtl_subkomponen)
			where
				a.jns_sumber_dana=1 and a.skala_kegiatan=2');
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
			$posts=DB::select($query. ' and (h.jenis_komponen_keg like "%'.$search.'%" or i.nama like "%'.$search.'%" or j.nama like "%'.$search.'%" or a.jns_sumber_dana like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or a.tahun like "%'.$search.'%" or a.tgl_realisasi like "%'.$search.'%" or a.vol_realisasi like "%'.$search.'%" or a.satuan like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (h.jenis_komponen_keg like "%'.$search.'%" or i.nama like "%'.$search.'%" or j.nama like "%'.$search.'%" or a.jns_sumber_dana like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or a.tahun like "%'.$search.'%" or a.tgl_realisasi like "%'.$search.'%" or a.vol_realisasi like "%'.$search.'%" or a.satuan like "%'.$search.'%")) a');
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

				$url_edit=url('/')."/main/pelaksanaan/kelurahan/ksm/create?kode=".$edit;
				$url_delete=url('/')."/main/pelaksanaan/kelurahan/ksm/delete?kode=".$delete;
				$nestedData['kode_parent'] = $post->real_komponen.$post->usulan_komponen.'-'.$post->nama_subkomponen.'-'.$post->nama_dtl_subkomponen;
				$nestedData['jns_sumber_dana'] = $jns_sumber_dana;
				$nestedData['kode_kel'] = $post->nama_kel;
				$nestedData['kode_faskel'] = $post->nama_faskel;
				$nestedData['kode_kawasan'] = $post->nama_kawasan;
				$nestedData['id_ksm'] = $post->nama_ksm;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['created_time'] = $post->created_time;

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
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
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
				if($item->kode_menu==120)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$rowData = DB::select('select * from bkt_01040201_real_keg where kode='.$data['kode']);
			$data['kode_parent_list'] = DB::select('
				select 
					a.*, 
					b.nama nama_subkomponen,
					c.nama nama_dtl_subkomponen
				from bkt_01030208_usulan_keg_kt a
					left join bkt_01010120_subkomponen b on b.id=a.id_subkomponen
					left join bkt_01010121_dtl_subkomponen c on c.id=a.id_dtl_subkomponen 
				where
					a.kode='.$rowData[0]->kode_parent);
			$data['data_kegiatan_list'] = DB::select('select 
						a.*,
						b.nama nama_kmw,
						c.nama nama_kota,
						d.nama nama_korkot,
						e.nama nama_kec,
						f.nama nama_kel,
						g.nama nama_faskel,
						h.nama nama_kpp,
						i.nama nama_kawasan,
						j.nama nama_ksm,
						k.nama nama_kpp
					from bkt_01040201_real_keg a
						left join bkt_01010110_kmw b on a.kode_kmw=b.kode
						left join bkt_01010102_kota c on a.kode_kota=c.kode 
						left join bkt_01010111_korkot d on a.kode_korkot=d.kode
						left join bkt_01010103_kec e on a.kode_kec=e.kode
						left join bkt_01010104_kel f on a.kode_kel=f.kode
						left join bkt_01010113_faskel g on a.kode_faskel=g.kode
						left join bkt_01010129_kpp h on a.id_kpp=h.id 
						left join bkt_01010123_kawasan i on a.kode_kawasan=i.id
						left join bkt_01010128_ksm j on a.id_ksm=j.id
						left join bkt_01010129_kpp k on a.id_kpp=k.id
					where a.kode='.$rowData[0]->kode);
			$data['jns_sumber_dana'] = $rowData[0]->jns_sumber_dana;
			$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
			$data['kode_parent'] = $rowData[0]->kode_parent;
			$data['kode_kmw'] = $data['data_kegiatan_list'][0]->nama_kmw;
			$data['kode_kota'] = $data['data_kegiatan_list'][0]->nama_kota;
			$data['kode_korkot'] = $data['data_kegiatan_list'][0]->nama_korkot;
			$data['kode_kec'] = $data['data_kegiatan_list'][0]->nama_kec;
			$data['kode_kel'] = $data['data_kegiatan_list'][0]->nama_kel;
			$data['kode_faskel'] = $data['data_kegiatan_list'][0]->nama_faskel;
			$data['kode_kawasan'] = $data['data_kegiatan_list'][0]->nama_kawasan;
			$data['id_ksm'] = $data['data_kegiatan_list'][0]->nama_ksm;
			$data['id_kpp'] = $data['data_kegiatan_list'][0]->nama_kpp;
			$data['komponen'] = DB::select('
				select
				case
					when jenis_komponen_keg = "L" then "Lingkungan"
					when jenis_komponen_keg = "S" then "Sosial"
					when jenis_komponen_keg = "E" then "Ekonomi"
				end komponen
				from bkt_01030208_usulan_keg_kt
				where
					kode='.$rowData[0]->kode_parent);
			$data['jenis_komponen_keg'] = $data['komponen'][0]->komponen;
			$data['subkomponen'] = DB::select('
				select  
					b.nama nama_subkomponen
				from bkt_01030208_usulan_keg_kt a
					left join bkt_01010120_subkomponen b on b.id=a.id_subkomponen
				where
					a.kode='.$rowData[0]->kode_parent);
			$data['id_subkomponen'] = $data['subkomponen'][0]->nama_subkomponen;
			$data['dtl_subkomponen'] = DB::select('
				select 
					b.nama nama_dtl_subkomponen
				from bkt_01030208_usulan_keg_kt a
					left join bkt_01010121_dtl_subkomponen b on b.id=a.id_dtl_subkomponen 
				where
					a.kode='.$rowData[0]->kode_parent);
			$data['id_dtl_subkomponen'] = $data['dtl_subkomponen'][0]->nama_dtl_subkomponen;
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
			$data['nb_non_gov'] = $rowData[0]->nb_non_gov;
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
			$data['tk_val_hok'] = $rowData[0]->tk_val_hok;
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
			$data['kode_ksm_list'] = DB::select('select * from bkt_01010128_ksm');
			$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
			return view('MAIN/bk010408/create',$data);
		}
	}

	public function post_create(Request $request)
	{
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode'))
			->update([
				'id_ksm' => $request->input('select-id_ksm-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
			$this->log_aktivitas('Update', 376);
		
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::beginTransaction();
		DB::table('bkt_01040206_real_keg_pmft')->where('kode_real_keg', $request->input('kode'))->delete();
		DB::commit();

		DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 377);
        return Redirect::to('/main/pelaksanaan/kelurahan/ksm');
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
